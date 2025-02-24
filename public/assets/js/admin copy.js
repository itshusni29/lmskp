document.addEventListener('DOMContentLoaded', function () {
    // Cek apakah data tersedia
    if (window.dashboardData) {
        console.log(window.dashboardData); // Cek data di konsol

        // Parse the string data into arrays
        var userGrowthData = JSON.parse(window.dashboardData.userGrowthData);
        var userGrowthMonths = JSON.parse(window.dashboardData.userGrowthMonths);
        var ltcCounts = JSON.parse(window.dashboardData.ltcCounts);
        var ltcCategories = JSON.parse(window.dashboardData.ltcCategories);

        // Filter data untuk hanya menampilkan bulan-bulan dalam tahun 2025
        var filteredMonths = [];
        var filteredData = [];
        var currentYear = new Date().getFullYear(); // Dapatkan tahun berjalan (2025)

        // Iterasi bulan dan data user untuk menyaring data berdasarkan tahun 2025
        for (var i = 0; i < userGrowthMonths.length; i++) {
            var month = userGrowthMonths[i];
            var year = parseInt(month.split(" ")[1]); // Ambil tahun dari format "Month YYYY"

            if (year === 2025) {
                filteredMonths.push(month);
                filteredData.push(userGrowthData[i]);
            }
        }

        // Urutkan bulan agar Januari muncul pertama
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
                    type: "bar", // Bar chart for user growth
                    height: 350
                },
                series: [{
                    name: 'Users',
                    data: filteredData // Gunakan data yang sudah difilter
                }],
                xaxis: {
                    categories: filteredMonths, // Label untuk bulan yang sudah difilter
                    title: {
                        text: 'Months'
                    }
                },
                yaxis: {
                    title: {
                        text: 'User Count'
                    }
                },
                colors: ['#0d6efd'], // Primary color for bars
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
    } else {
        console.log("Dashboard data not found.");
    }
});
