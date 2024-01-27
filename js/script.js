(function ($) {
    "use strict";

    var Main = {
        init: function () {
            this.Basic.init();
        },

        Basic: {
            init: function () {
                this.chartCal();
                this.apy7Cal();
                this.apy9Cal();
            },
            chartCal: function () {
                $(document).ready(function () {
                    var ctx = document.getElementById('chart').getContext('2d');
                    var chart;

                    function calculatePayout(investmentAmount, apy, months) {
                        var data = [];
                        var total = 0;

                        for (var i = 1; i <= months; i++) {
                            var payout = (investmentAmount * apy) / 12;
                            total += payout;
                            data.push({ x: i, y: investmentAmount + total });
                        }

                        return data;
                    }

                    function updateChart() {
                        var investmentAmount = parseInt($('#investmentAmount').val()) || 0;
                        var months = parseInt($('#months').val()) || 0;
                        var tier = parseFloat($('#tier').val());

                        // Set minimum investment amount based on selected tier
                        var minInvestmentAmount;
                        switch (tier) {
                            case 0.07:
                                minInvestmentAmount = 10000; // Gold
                                break;
                            case 0.09:
                                minInvestmentAmount = 50000; // Platinum
                                break;
                            default:
                                minInvestmentAmount = 10000; // Default to 10000
                        }

                        // Apply the minimum investment amount
                        if (investmentAmount < minInvestmentAmount) {
                            $('#investmentAmount').val(minInvestmentAmount);
                            investmentAmount = minInvestmentAmount;
                        }

                        // Set apy based on selected tier
                        var apy;
                        switch (tier) {
                            case 0.07:
                                apy = 0.07; // Gold
                                break;
                            case 0.09:
                                apy = 0.09; // Platinum
                                break;
                            default:
                                apy = 0.00; // Default to 7%
                        }

                        $('#realTimeAPYValue').text((Math.round(apy * 100)) + '%'); // Update real-time APY display

                        var data = calculatePayout(investmentAmount, apy, months);

                        if (chart) {
                            chart.destroy();
                        }
                        chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'Total Growth',
                                    data: data,
                                    borderColor: '#BB0504',
                                    backgroundColor: '#BB05044b',
                                    fill: true,
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        type: 'linear',
                                        position: 'bottom',
                                        ticks: {
                                            stepSize: 1,
                                            precision: 0,
                                        }
                                    },
                                    y: {
                                        type: 'linear',
                                        position: 'right',
                                        ticks: {
                                            callback: function (value, index, values) {
                                                return '$' + (value / 1000) + 'K';
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                    $('#investmentAmount, #months, #tier').on('input', function () {
                        updateChart();
                    });

                    // Initial chart update
                    updateChart();
                });
            },
            apy7Cal: function (){
                $(document).ready(function () {
                    function calculateProfit7() {
                        const investmentAmount7 = parseFloat($('#investmentAmount7').val());
                        const monthTerm7 = parseInt($('#monthTerm7').val());

                        if (investmentAmount7 >= 10000 && investmentAmount7 <= 50000 && monthTerm7 >= 4 && monthTerm7 <= 100) {
                            const monthlyProfit7 = (investmentAmount7 * 0.07) / 12;
                            const yearlyProfit7 = monthlyProfit7 * monthTerm7;

                            $('#monthlyProfit7').text('Monthly Payouts: $' + monthlyProfit7.toFixed(2));
                            $('#yearlyProfit7').text('Total Gained: $' + yearlyProfit7.toFixed(2));
                        } else {
                            $('#monthlyProfit7').text('Monthly Payouts: $0.00');
                            $('#yearlyProfit7').text('Total Gained: $0.00');
                        }
                    }

                    // Calculate profit on input change
                    $('#investmentAmount7, #monthTerm7').on('input', calculateProfit7);

                    // Initial calculation with default values
                    calculateProfit7();
                });
            },
            apy9Cal: function (){
                $(document).ready(function () {
                    function calculateProfit9() {
                        const investmentAmount9 = parseFloat($('#investmentAmount9').val());
                        const monthTerm9 = parseInt($('#monthTerm9').val());

                        if (investmentAmount9 >= 50000 && monthTerm9 >= 4 && monthTerm9 <= 100) {
                            const monthlyProfit9 = (investmentAmount9 * 0.09) / 12;
                            const yearlyProfit9 = monthlyProfit9 * monthTerm9;

                            $('#monthlyProfit9').text('Monthly Payouts: $' + monthlyProfit9.toFixed(2));
                            $('#yearlyProfit9').text('Total Gained: $' + yearlyProfit9.toFixed(2));
                        } else {
                            $('#monthlyProfit9').text('Monthly Payouts: $0.00');
                            $('#yearlyProfit9').text('Total Gained: $0.00');
                        }
                    }

                    // Calculate profit on input change
                    $('#investmentAmount9, #monthTerm9').on('input', calculateProfit9);

                    // Initial calculation with default values
                    calculateProfit9();
                });
            }
        },
    };
    jQuery(document).ready(function () {
        Main.init();
    });
})(jQuery);
