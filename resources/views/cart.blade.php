<script>
            $(document).ready(function () {
            let instanceCart1; // Variable to store the chart instance
            let instanceCart2; // Variable to store the chart instance
            let instanceCart3; // Variable to store the chart instance
            let instanceCart4; // Variable to store the chart instance
            const purpleColor = '#836AF9',
                yellowColor = '#ffe800',
                cyanColor = '#28dac6',
                orangeColor = '#FF8132',
                orangeLightColor = '#ffcf5c',
                oceanBlueColor = '#299AFF',
                greyColor = '#4F5D70',
                greyLightColor = '#EDF1F4',
                blueColor = '#2B9AFF',
                blueLightColor = '#84D0FF';
            let cardColor, headingColor, labelColor, borderColor, legendColor;
            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                headingColor = config.colors_dark.headingColor;
                labelColor = config.colors_dark.textMuted;
                legendColor = config.colors_dark.bodyColor;
                borderColor = config.colors_dark.borderColor;
            } else {
                cardColor = config.colors.cardColor;
                headingColor = config.colors.headingColor;
                labelColor = config.colors.textMuted;
                legendColor = config.colors.bodyColor;
                borderColor = config.colors.borderColor;
            }
            const chartList = document.querySelectorAll('.chartjs');
            chartList.forEach(function (chartListItem) {
                chartListItem.height = chartListItem.dataset.height;
            });

            function loadChartData(year, jenjang, fakultas, prodi) {
                $.ajax({
                    url: `{{ route('mhs.data') }}`,
                    method: 'GET',
                    data: {
                        angkatan: year,
                        jenjang: jenjang,
                        fakultas: fakultas,
                        prodi: prodi
                    },
                    success: function (response) {

                        $("#totalData").text(response.total);
                        const groupedData = groupBy(response.data, 'prodi_mhs');
                        const prodiCounts = Object.keys(groupedData).map(prodi => {
                            return {
                                prodi_mhs: prodi,
                                total: groupedData[prodi].length
                            };
                        });

                        // Sort by total number of students and get top 8
                        const top8Prodi = prodiCounts.sort((a, b) => b.total - a.total).slice(0,
                            10);

                        const labels = top8Prodi.map(item => item.prodi_mhs);
                        const data = top8Prodi.map(item => item.total);
                        // Update all charts with new data
                        updateChart('horizontalBarChart', labels, data);

                        // Mengelompokkan data berdasarkan jenis kelamin
                        const groupedByGender = groupBy(response.data, 'kelamin_mhs');

                        // Membuat array untuk menyimpan total jumlah mahasiswa per jenis kelamin
                        const genderCounts = [];
                        const genderLabels = [];

                        if (groupedByGender['L']) {
                            genderCounts.push(groupedByGender['L'].length);
                            genderLabels.push('Laki-Laki');
                        } else {
                            genderCounts.push(0);
                            genderLabels.push('Laki-Laki');
                        }

                        if (groupedByGender['P']) {
                            genderCounts.push(groupedByGender['P'].length);
                            genderLabels.push('Perempuan');
                        } else {
                            genderCounts.push(0);
                            genderLabels.push('Perempuan');
                        }

                        const totalGenders = genderCounts.reduce((acc, val) => acc + val, 0);

                        // Update grafik donat dengan data total per jenis kelamin
                        genderCart(genderCounts, genderLabels);

                        // Update legend dengan persentase
                        updateLegend(genderCounts, totalGenders);
                        // Memproses data untuk grafik polar area berdasarkan IPK dan jenis kelamin
                        const ipkData = groupDataByIpkAndGender(response.data);
                        ipkPolarChart(ipkData);

                        const jalurMasukData = countMahasiswaByJalurMasuk(response.data);

                        // Filter data dengan total di atas 20
                        const filteredJalurMasukData = filterDataByTotal(jalurMasukData, 20);

                        // Proses data untuk grafik batang berdasarkan jalur masuk
                        jalurMasukBarChart(filteredJalurMasukData);

                    }
                });
            }

            function filterDataByTotal(data, threshold) {
                const filteredData = {};
                for (const key in data) {
                    if (data.hasOwnProperty(key) && data[key] > threshold) {
                        filteredData[key] = data[key];
                    }
                }
                return filteredData;
            }

            function countMahasiswaByJalurMasuk(data) {
                const counts = {};
                data.forEach(mahasiswa => {
                    const jalurMasuk = mahasiswa.jalur_masuk;
                    counts[jalurMasuk] = (counts[jalurMasuk] || 0) + 1;
                });
                return counts;
            }

            function groupBy(array, key) {
                return array.reduce((result, currentValue) => {
                    (result[currentValue[key]] = result[currentValue[key]] || []).push(currentValue);
                    return result;
                }, {});
            }

            function updateChart(chartId, labels, data) {
                if (instanceCart1) {
                    instanceCart1.destroy();
                }
                const horizontalBarChart = document.getElementById('horizontalBarChart');
                if (horizontalBarChart) {
                    instanceCart1 = new Chart(horizontalBarChart, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: cyanColor,
                                borderColor: 'transparent',
                                maxBarThickness: 15
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 500
                            },
                            elements: {
                                bar: {
                                    borderRadius: {
                                        topRight: 15,
                                        bottomRight: 15
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    min: 0,
                                    grid: {
                                        color: borderColor,
                                        borderColor: borderColor
                                    },
                                    ticks: {
                                        color: labelColor
                                    }
                                },
                                y: {
                                    grid: {
                                        borderColor: borderColor,
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: labelColor
                                    }
                                }
                            }
                        }
                    });
                }
            }

            function genderCart(genderTotal, genderData) {
                if (instanceCart2) {
                    instanceCart2.destroy();
                }
                const genderCartPie = document.getElementById('doughnutChart');
                if (genderCartPie) {
                    instanceCart2 = new Chart(genderCartPie, {
                        type: 'doughnut',
                        data: {
                            labels: genderData,
                            datasets: [{
                                data: genderTotal,
                                backgroundColor: [cyanColor, orangeLightColor, config.colors
                                    .primary
                                ],
                                borderWidth: 0,
                                pointStyle: 'rectRounded'
                            }]
                        },
                        options: {
                            responsive: true,
                            animation: {
                                duration: 500
                            },
                            cutout: '68%',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            const label = context.label || '';
                                            const value = context.raw;
                                            const output = ' ' + label + ' : ' + value +
                                                ' Mahasiswa';
                                            return output;
                                        }
                                    },
                                    // Updated default tooltip UI
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                }
                            }
                        }
                    });
                }
            }

            function groupDataByIpkAndGender(data) {
                const ipkRanges = {
                    'IPK: 0.00-2.00': {
                        min: 0.00,
                        max: 2.00,
                        L: 0,
                        P: 0
                    },
                    'IPK: 2.01-2.50': {
                        min: 2.01,
                        max: 2.50,
                        L: 0,
                        P: 0
                    },
                    'IPK: 2.51-3.00': {
                        min: 2.51,
                        max: 3.00,
                        L: 0,
                        P: 0
                    },
                    'IPK: 3.01-3.50': {
                        min: 3.01,
                        max: 3.50,
                        L: 0,
                        P: 0
                    },
                    'IPK: 3.51-4.00': {
                        min: 3.51,
                        max: 4.00,
                        L: 0,
                        P: 0
                    }
                };

                data.forEach(student => {
                    const ipk = parseFloat(student.ipk_mhs);
                    const gender = student.kelamin_mhs;

                    for (const range in ipkRanges) {
                        if (ipk >= ipkRanges[range].min && ipk <= ipkRanges[range].max) {
                            ipkRanges[range][gender]++;
                            break;
                        }
                    }
                });

                return ipkRanges;
            }

            function updateLegend(genderCounts, total) {
                const lakiLakiPercent = ((genderCounts[0] / total) * 100).toFixed(2);
                const perempuanPercent = ((genderCounts[1] / total) * 100).toFixed(2);

                document.getElementById('Laki-Laki').innerText = `${lakiLakiPercent} %`;
                document.getElementById('Perempuan').innerText = `${perempuanPercent} %`;
            }
            loadChartData(2023, null, null, null);

            function ipkPolarChart(ipkData) {
                if (instanceCart3) {
                    instanceCart3.destroy();
                }
                const ipkCart = document.getElementById('polarChart');
                if (polarChart) {
                    const labels = Object.keys(ipkData);
                    const dataLakiLaki = labels.map(range => ipkData[range]['L']);
                    const dataPerempuan = labels.map(range => ipkData[range]['P']);
                    const nonEmptyLabels = [];
                    const nonEmptyDataLakiLaki = [];
                    const nonEmptyDataPerempuan = [];

                    // Memeriksa apakah ada data yang tersedia untuk setiap rentang IPK
                    labels.forEach((range, index) => {
                        if (dataLakiLaki[index] > 0 || dataPerempuan[index] > 0) {
                            nonEmptyLabels.push(range);
                            nonEmptyDataLakiLaki.push(dataLakiLaki[index]);
                            nonEmptyDataPerempuan.push(dataPerempuan[index]);
                        }
                    });

                    const backgroundColors = generateRandomColors(nonEmptyLabels.length);

                    instanceCart3 = new Chart(polarChart, {
                        type: 'polarArea',
                        data: {
                            labels: nonEmptyLabels,
                            datasets: [{
                                    label: 'Laki-Laki',
                                    backgroundColor: backgroundColors,
                                    borderColor: 'rgba(255, 255, 255, 1)',
                                    borderWidth: 1,
                                    data: nonEmptyDataLakiLaki
                                },
                                {
                                    label: 'Perempuan',
                                    backgroundColor: backgroundColors,
                                    borderColor: 'rgba(255, 255, 255, 1)',
                                    borderWidth: 1,
                                    data: nonEmptyDataPerempuan
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 500
                            },
                            scales: {
                                r: {
                                    ticks: {
                                        display: false,
                                        color: labelColor
                                    },
                                    grid: {
                                        circular: true
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    // Updated default tooltip UI
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                },
                                legend: {
                                    rtl: isRtl,
                                    position: 'right',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 25,
                                        boxWidth: 8,
                                        boxHeight: 8,
                                        color: legendColor,
                                        font: {
                                            family: 'Inter'
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            function jalurMasukBarChart(data) {
                if (instanceCart4) {
                    instanceCart4.destroy();
                }
                const jalurMasukChart = document.getElementById('barChart');
                if (jalurMasukChart) {
                    const jalurMasukLabels = Object.keys(data);
                    const jalurMasukData = Object.values(data);
                    instanceCart4 = new Chart(jalurMasukChart, {
                        type: 'bar',
                        data: {
                            labels: jalurMasukLabels,
                            datasets: [{
                                data: jalurMasukData,
                                backgroundColor: orangeLightColor,
                                borderColor: 'transparent',
                                maxBarThickness: 50,
                                borderRadius: {
                                    topRight: 15,
                                    topLeft: 15
                                }
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 500
                            },
                            plugins: {
                                tooltip: {
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        color: borderColor,
                                        drawBorder: false,
                                        borderColor: borderColor
                                    },
                                    ticks: {
                                        color: labelColor
                                    }
                                },
                                y: {
                                    min: 0,
                                    grid: {
                                        color: borderColor,
                                        drawBorder: false,
                                        borderColor: borderColor
                                    },
                                    ticks: {
                                        stepSize: 100,
                                        color: labelColor
                                    }
                                }
                            }
                        }
                    });
                }
            }

            function generateRandomColors(numColors) {
                const colors = [];
                for (let i = 0; i < numColors; i++) {
                    const color =
                        `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.5)`;
                    colors.push(color);
                }
                return colors;
            }
            $('#angkatan, #jenjang, #fakultas, #prodi').change(function () {
                const year = $('#angkatan').val();
                const jenjang = $('#jenjang').val();
                const fakultas = $('#fakultas').val();
                const prodi = $('#prodi').val();
                loadChartData(year, jenjang, fakultas, prodi);
            });
        });

</script>
