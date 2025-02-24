document.addEventListener('DOMContentLoaded', function () {
    // Cek apakah data tersedia
    if (window.dashboardData) {
        console.log(window.dashboardData); // Cek data di konsol

        // Parse the string data into arrays
        var userGrowthData = JSON.parse(window.dashboardData.userGrowthData);
        var userGrowthMonths = JSON.parse(window.dashboardData.userGrowthMonths);
        var ltcCounts = JSON.parse(window.dashboardData.ltcCounts);
        var ltcCategories = JSON.parse(window.dashboardData.ltcCategories);

        var totalUsersDates = JSON.parse(window.dashboardData.totalUsersDates);
        var totalUsersData = JSON.parse(window.dashboardData.totalUsersData);

        var totalModulesDates = JSON.parse(window.dashboardData.totalModulesDates);
        var totalModulesData = JSON.parse(window.dashboardData.totalModulesData);

        // Filter data untuk hanya menampilkan bulan-bulan dalam tahun 2025
        var filteredMonths = [];
        var filteredData = [];
        var currentYear = new Date().getFullYear(); // Dapatkan tahun berjalan (2025)

        for (var i = 0; i < userGrowthMonths.length; i++) {
            var month = userGrowthMonths[i];
            var year = parseInt(month.split(" ")[1]);

            if (year === 2025) {
                filteredMonths.push(month);
                filteredData.push(userGrowthData[i]);
            }
        }
        // Parse the string data into arrays
        var totalClassesData = JSON.parse(window.dashboardData.totalClassesData);
        var totalClassesDates = JSON.parse(window.dashboardData.totalClassesDates);



        // Urutkan bulan
        var sortedMonthsData = filteredMonths.map(function (month, index) {
            return { month: month, data: filteredData[index] };
        });

        sortedMonthsData.sort(function (a, b) {
            var monthOrder = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            return monthOrder.indexOf(a.month.split(" ")[0]) - monthOrder.indexOf(b.month.split(" ")[0]);
        });

        filteredMonths = sortedMonthsData.map(function (item) {
            return item.month;
        });
        filteredData = sortedMonthsData.map(function (item) {
            return item.data;
        });

        // Chart untuk User Growth (Bar Chart)
        if ($('#userStats').length) {
            var options1 = {
                chart: {
                    type: "bar",
                    height: 350
                },
                series: [{
                    name: 'Users',
                    data: filteredData
                }],
                xaxis: {
                    categories: filteredMonths,
                    title: {
                        text: 'Months'
                    }
                },
                yaxis: {
                    title: {
                        text: 'User Count'
                    }
                },
                colors: ['#0d6efd'],
                plotOptions: {
                    bar: {
                        columnWidth: '40%',
                        distributed: true
                    }
                },
                title: {
                    text: 'User Growth by Month (2025)',
                    align: 'center',
                    style: {
                        fontSize: '16px',
                        fontWeight: 'bold',
                    }
                }
            };

            new ApexCharts(document.querySelector("#userStats"), options1).render();
        }

        // Chart untuk User Distribution by LTC (Pie Chart)
        if (document.querySelector('#usersltc')) {
            var optionsLTC = {
                chart: {
                    type: 'pie',
                    height: 300,
                },
                series: ltcCounts,
                labels: ltcCategories,
                colors: ['#0d6efd', '#f1c40f', '#e74c3c'],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + ' users';
                        }
                    }
                },
                title: {
                    align: 'center',
                    style: {
                        fontSize: '16px',
                        fontWeight: 'bold',
                    }
                }
            };

            new ApexCharts(document.querySelector('#usersltc'), optionsLTC).render();
        }

        // Chart untuk Total Users Growth by Date (Line Chart)
        if ($('#totalUsersStats').length) {
            var optionsUsers = {
                chart: {
                    type: "line",
                    height: 60,
                    sparkline: {
                        enabled: true
                    }
                },
                series: [{
                    name: 'Total Users',
                    data: totalUsersData // Ganti dengan data asli
                }],
                xaxis: {
                    type: 'datetime',
                    categories: totalUsersDates // Ganti dengan data asli
                },
                stroke: {
                    width: 2,
                    curve: "smooth"
                },
                markers: {
                    size: 0
                },
                colors: ['#28a745'], // Sesuaikan dengan warna yang diinginkan
            };
        
            new ApexCharts(document.querySelector("#totalUsersStats"), optionsUsers).render();
        }
        

        if ($('#totalModulesStats').length) {
            var optionsModules = {
                chart: {
                    type: "line",
                    height: 60,
                    sparkline: {
                        enabled: true
                    }
                },
                series: [{
                    name: 'Total Modules',
                    data: totalModulesData // Ganti dengan data asli
                }],
                xaxis: {
                    type: 'datetime',
                    categories: totalModulesDates // Ganti dengan data asli
                },
                stroke: {
                    width: 2,
                    curve: "smooth"
                },
                markers: {
                    size: 0
                },
                colors: ['#ffc107'], // Sesuaikan dengan warna yang diinginkan
            };
        
            new ApexCharts(document.querySelector("#totalModulesStats"), optionsModules).render();
        }
        if ($('#totalClassesStats').length) {
            var optionsClasses = {
                chart: {
                    type: "line",
                    height: 60,
                    sparkline: {
                        enabled: true
                    }
                },
                series: [{
                    name: 'Total Classes',
                    data: totalClassesData // Use the actual data
                }],
                xaxis: {
                    type: 'datetime',
                    categories: totalClassesDates // Use the actual date data
                },
                stroke: {
                    width: 2,
                    curve: "smooth"
                },
                markers: {
                    size: 0
                },
                colors: ['#0d6efd'], // Set the color to the primary color
            };
        
            new ApexCharts(document.querySelector("#totalClassesStats"), optionsClasses).render();
        }
        



    }
});
