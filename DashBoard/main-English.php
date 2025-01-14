

<?php
session_start();  // 세션 시작

// 세션에서 사용자 이름을 가져옵니다.
$userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : '이름없음';  // 사용자 이름이 없으면 '이름없음' 표시
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dongui University Web Server Team Project</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

    <div class="container">
        <!-- 사이드바 -->
        <aside class="sidebar">
            <div class="user-info">
                <h3>Login information</h3>
                <p>Username: <?php echo htmlspecialchars($userName); ?></p>
            </div>

            <hr> <!-- 구분선 -->
            
            <br>
                <h2>health indicator</h2>
                <ul id="disease-list">
                    <!-- 암 검사 -->
                    <li onclick="toggleSubMenu('cancer-menu', this)">Cancer Screening<span class="toggle-icon plus-icon"></span></li>
<ul id="cancer-menu" class="sub-menu">
    <li onclick="showIndicators('liver-cancer')">liver cancer</li>
    <li onclick="showIndicators('stomach-cancer')">stomach cancer</li>
    <li onclick="showIndicators('lung-cancer')">lung cancer</li>
    <li onclick="showIndicators('breast-cancer')">breast cancer</li>
    <li onclick="showIndicators('colon-cancer')">colorectal cancer</li>
</ul>
    
                    <!-- 당뇨병 -->
                    <li onclick="showIndicators('diabetes')">Diabetes</li>
    
                    <!-- 뇌 질환 -->
                    <li onclick="toggleSubMenu('brain-disease-menu', this)">brain disease<span class="toggle-icon plus-icon"></span></li>
                    <ul id="brain-disease-menu" class="sub-menu">
                        <li onclick="showIndicators('depression')">Depression</li>
                        <li onclick="showIndicators('dementia')">Dementia</li>
                        <li onclick="showIndicators('stroke')">stroke</li>
                    </ul>
    
                    <!-- 고혈압 -->
                    <li onclick="showIndicators('hypertension')">High blood pressure</li>
                </ul>


                <hr>
                <div class="health-check-info">
                <h3>Free Health Check-up Eligibility for 2024</h3>
<ul>
    <li><strong>Men aged 40 and above, Women aged 45 and above: </strong> free every year.</li>
    <li><strong>Even Year 2024:</strong> recipients of even years.</li>
    <li><strong>20s/30s:</strong> High-risk groups can be tested.</li>
    <li><strong>High risk group:</strong> free of charge regardless of age.</li>
</ul>
<p><a href="https://www.nhis.or.kr/nhis/index.do" target="_blank" class="healthcheck-link">Shortcut application</a></p>

        </aside>

        <!-- 대시보드 내용 -->
        <div class="dashboard-content">
            <header>
                <h1>Dongui-Uni web project(HTML,CSS,JS,PHP,MySQL-based dashboard)</h1>
                <button id="back-btn" class="back-btn">Go backwards</button>
                <select id="language-select" onchange="changeLanguage()">
                    <option value="en">English</option> <!--수정-->
                    <option value="ko">한국어</option> <!--수정-->
                </select>
            </header>

            <!-- 건강 지표 분석 -->
            <section class="analysis-section">
                <h2>Annual health examination participation rate</h2>
                <div class="charts">
                    <div class="chart" id="weight-chart">
                        <h3>by gender</h3>
                
                        <canvas id="gender-chart"></canvas> <!-- 성별 차트 -->
                    </div>
                    <div class="chart" id="blood-pressure-chart">
                        <h3>by age</h3>
                        <canvas id="age-group-chart"></canvas> <!-- 나이별 차트 -->
                    </div>
                   
                </div>
            </section>
        


            <section class="analysis-section">
    <h2>disease incidence</h2>
    <div class="charts">
        <div class="chart" id="disease-gender-chart">
            <h3>by gender</h3>
            
            <canvas id="disease-gender-chart-canvas" width="450" height="300"></canvas> <!-- 성별 질병 발병률 차트 -->
        </div>
        <div class="chart" id="disease-age-chart">
            <h3>by age</h3>
            <canvas id="disease-age-chart-canvas"></canvas> <!-- 나이별 질병 발병률 차트 -->
        </div>
    </div>
</section>
            
           

            <!-- 질환 정보 -->
            <section class="health-tips">
                <h2>Disease Overview</h2>
                <div id="health-tips-content">
                    <p>This section provides useful information, including key symptoms, causes, and areas of the disease.</p>
                </div>
            </section>

            <!-- 예방 방법 -->
            <section class="goal-setting">
                <h2>Prevention Rules and Expert Opinions</h2>
                <div class="goal-content">
                <p id="prevention-tips">Provides expert prevention rules and findings for a healthy life.</p>
                <div id="expert-opinion-video"></div>
                </div>
            </section>


            <!-- 푸터 -->
            <div class="footer">
                <p>© 2024 Health Report Dashboard</p>
                <p>Dong-eui University</p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

    <script>
        // 서브 메뉴 토글 기능
        function toggleSubMenu(menuId, liElement) {
            var menu = document.getElementById(menuId);
            var icon = liElement.querySelector('.toggle-icon');
            
            // 서브 메뉴 애니메이션 적용
            if (menu.style.display === "block") {
                menu.style.display = "none";
                menu.style.maxHeight = "0";
                icon.classList.remove('minus-icon');
                icon.classList.add('plus-icon');
            } else {
                menu.style.display = "block";
                menu.style.maxHeight = menu.scrollHeight + "px";  // 서브 메뉴의 실제 높이를 기반으로 애니메이션
                icon.classList.remove('plus-icon');
                icon.classList.add('minus-icon');
            }
        }

       

     // 언어 선택 기능
     function changeLanguage() {
    // 언어 선택 값 가져오기
    const selectedLanguage = document.getElementById('language-select').value;
    // 한국어 선택 시 main.php로 이동
    if (selectedLanguage === 'ko') { //수정
    window.location.href = 'main.php'; //수정
    }
    // 영어 선택 시 main-English.php로 이동
    else if (selectedLanguage === 'en') { //수정
    window.location.href = 'main-English.php';  //수정
    }
}






const genderData = {
    labels: ['Male', 'Female'], // Gender
    datasets: [{
        label: 'Participation Rate (%)',
        data: [
            (8907506 / 11697034) * 100, // Male participation rate
            (8325757 / 11164598) * 100  // Female participation rate
        ], // Participation rate by gender
        backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 99, 132, 0.6)'],
        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'], // Border colors
        borderWidth: 1
    }]
};

const ctxGender = document.getElementById('gender-chart').getContext('2d');
const genderChart = new Chart(ctxGender, {
    type: 'bar', // Bar chart
    data: genderData,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toFixed(2) + '%'; // Display percentage
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: true, // Enable legend
                position: 'top', // Legend position (top, bottom, left, right, etc.)
                labels: {
                    generateLabels: function(chart) {
                        // Modify legend labels if needed
                        const labels = chart.data.datasets[0].data;
                        return chart.data.labels.map(function(label, index) {
                            return {
                                text: label, // Gender name in the label
                                fillStyle: chart.data.datasets[0].backgroundColor[index], // Corresponding color
                                strokeStyle: chart.data.datasets[0].borderColor[index], // Border color
                                lineWidth: 1,
                                index: index
                            };
                        });
                    }
                }
            }
        }
    }
});

const ageData = {
    labels: ['Under 19', '20 ~ 24 years', '25 ~ 29 years', '30 ~ 34 years', '35 ~ 39 years', '40 ~ 44 years', '45 ~ 49 years'],
    datasets: [
        {
            label: 'Male',
            data: [
                (7631 / 9291) * 100,  // Male participation rate for under 19
                (254753 / 565328) * 100,  // Male participation rate for 20-24 years
                (642198 / 839912) * 100,  // Male participation rate for 25-29 years
                (857859 / 1094158) * 100,  // Male participation rate for 30-34 years
                (775304 / 960742) * 100,  // Male participation rate for 35-39 years
                (1126201 / 1371584) * 100,  // Male participation rate for 40-44 years
                (928604 / 1138381) * 100   // Male participation rate for 45-49 years
            ],
            backgroundColor: 'rgba(54, 162, 235, 0.6)', // Color for males
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },
        {
            label: 'Female',
            data: [
                (4727 / 6244) * 100,  // Female participation rate for under 19
                (369882 / 635982) * 100,  // Female participation rate for 20-24 years
                (606400 / 758569) * 100,  // Female participation rate for 25-29 years
                (674357 / 899077) * 100,  // Female participation rate for 30-34 years
                (526460 / 720894) * 100,  // Female participation rate for 35-39 years
                (906829 / 1168862) * 100,  // Female participation rate for 40-44 years
                (767139 / 967460) * 100   // Female participation rate for 45-49 years
            ],
            backgroundColor: 'rgba(255, 99, 132, 0.6)', // Color for females
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }
    ]
};
const ctxAge = document.getElementById('age-group-chart').getContext('2d');
const ageGroupChart = new Chart(ctxAge, {
    type: 'bar', // Bar chart
    data: ageData,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toFixed(2) + '%'; // Display percentage
                    }
                }
            }
        }
    }
});




document.getElementById('back-btn').addEventListener('click', function() {
    window.location.reload();  // 페이지 새로 고침
});




function showIndicators(disease) {
  
 



    const healthTipsContent = document.getElementById('health-tips-content');
    const preventionContent = document.getElementById('prevention-and-expert-opinion');
    
    const preventionText = document.getElementById('prevention-tips');
    const expertVideo = document.getElementById('expert-opinion-video');

   

    if (disease === 'liver-cancer') {
    // Gender-specific chart data (Liver Cancer)
    healthTipsContent.innerHTML = `
    <h3>Liver Cancer Medical Information</h3>
    <p><strong>Liver cancer</strong> is a malignant tumor that occurs in the liver, which can be caused by hepatitis, cirrhosis, excessive alcohol consumption, etc. In the early stages, there are few symptoms, but as it progresses, symptoms such as fatigue, abdominal bloating, and jaundice may appear.</p>

    <h3>Stage-by-Stage Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> Symptoms are almost absent, though some patients may experience fatigue.</li>
        <li><strong>Stage 2:</strong> Weight loss, loss of appetite, vomiting, and pain in the upper right abdomen may occur.</li>
        <li><strong>Stage 3:</strong> Jaundice, abdominal bloating, vomiting, and bleeding during bowel movements may appear, and liver function may deteriorate significantly.</li>
        <li><strong>Stage 4:</strong> Metastasis occurs, with severe weight loss and systemic symptoms. Metastasis to other organs outside the liver happens.</li>
    </ul>

    <h3>Major Causes of Liver Cancer</h3>
    <ul>
        <li><strong>Hepatitis viruses (Hepatitis B, C):</strong> Hepatitis is one of the major causes of liver cancer, especially chronic hepatitis, which increases the risk of liver cancer.</li>
        <li><strong>Excessive alcohol consumption:</strong> Long-term excessive alcohol consumption can lead to cirrhosis, which can develop into liver cancer.</li>
        <li><strong>Cirrhosis:</strong> Cirrhosis is a disease in which liver cells are damaged and liver function deteriorates, and it is a major cause of liver cancer.</li>
        <li><strong>Non-alcoholic fatty liver disease:</strong> Non-alcoholic fatty liver disease is associated with obesity, diabetes, etc., and can develop into liver cancer.</li>
        <li><strong>Genetic factors:</strong> Liver cancer can be more common in people with a family history of the disease.</li>
    </ul>
`;

preventionText.innerHTML = `
    <h3>Liver Cancer Prevention Guidelines</h3>
    <ul>
        <li><strong>Preventing Hepatitis:</strong> Get vaccinated for Hepatitis B and C, and if you have hepatitis, seek treatment.</li>
        <li><strong>Healthy diet:</strong> Avoid excessive alcohol consumption, eat plenty of fresh vegetables and fruits, and reduce high-fat and high-calorie foods.</li>
        <li><strong>Regular exercise:</strong> Prevent obesity, manage your weight, and exercise regularly.</li>
        <li><strong>Preventing Cirrhosis:</strong> Cirrhosis can lead to liver cancer, so reduce alcohol intake and receive treatment for liver diseases.</li>
        <li><strong>Regular health checkups:</strong> Liver cancer has no early symptoms, so regular checkups are essential to monitor liver health.</li>
    </ul>

    <h3>Expert Opinion</h3>
    <p>Liver cancer has few early symptoms, and there are few signs to notice before it progresses. Therefore, regular health checkups, hepatitis vaccination, maintaining a healthy diet and exercise habits are crucial in preventing liver cancer. Also, early treatment of liver diseases is essential.</p>
`;

expertVideo.innerHTML = `
    <h4>Expert Interview: Liver Cancer Prevention</h4>
<iframe width="560" height="315" src="https://www.youtube.com/embed/PXmL_Bf30Nc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <p>Video provided by: YouTube Roswell Park Comprehensive Cancer Center Cannel</p>

`;

    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [115.3, 37.8], // Incidence rate for males and females
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Show incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-specific incidence rate chart data (Liver Cancer)
    const ageData = {
        labels: ['0-4 years', '5-9 years', '10-14 years', '15-19 years', '20-24 years', '25-29 years', '30-34 years', '35-39 years', '40-44 years', '45-49 years',
                 '50-54 years', '55-59 years', '60-64 years', '65-69 years', '70-74 years', '75-79 years', '80-84 years', '85 years and above'],
        datasets: [{
            label: 'Female Incidence Rate (%)',
            data: [3.2, 0.7, 0.4, 0.4, 0.6, 0.9, 2.5, 8.4, 21.3, 38.6, 
                   76.2, 121.8, 179.0, 229.9, 267.0, 274.5, 248.5, 146.6], // Female age-specific incidence rate
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: 'Male Incidence Rate (%)',
            data: [3.9, 0.4, 0.4, 0.4, 0.9, 0.6, 3.1, 10.3, 31.2, 60.8, 
                   123.1, 199.0, 292.1, 365.0, 412.0, 434.3, 414.9, 294.3], // Male age-specific incidence rate
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Show incidence rate
                        }
                    }
                }
            }
        }
    });
}


    
    // Stomach Cancer Data
else if (disease === 'stomach-cancer') {

healthTipsContent.innerHTML = `
    <h3>Stomach Cancer Medical Information</h3>
    <p><strong>Stomach cancer</strong> is a malignant tumor that originates in the stomach. In its early stages, there are often no symptoms. As it progresses, symptoms such as heartburn, weight loss, vomiting, and blood in the stool may appear.</p>

    <h3>Stage-wise Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> There are no noticeable symptoms, but occasional heartburn may occur.</li>
        <li><strong>Stage 2:</strong> Weight loss, discomfort after meals, stomach pain, and vomiting may occur.</li>
        <li><strong>Stage 3:</strong> Vomiting, blood in the stool, abdominal pain, and early satiety may appear, and the cancer may spread to surrounding tissues.</li>
        <li><strong>Stage 4:</strong> The cancer metastasizes to other organs, and severe weight loss and systemic symptoms may develop.</li>
    </ul>

    <h3>Main Causes of Stomach Cancer</h3>
    <ul>
        <li><strong>Helicobacter pylori infection:</strong> A bacterium that causes gastritis and is a major cause of stomach cancer.</li>
        <li><strong>Dietary habits:</strong> High-salt diets, salty foods, grilled foods, and processed foods increase the risk of stomach cancer.</li>
        <li><strong>Smoking and alcohol:</strong> Smoking and excessive alcohol consumption increase the risk of stomach cancer.</li>
        <li><strong>Genetic factors:</strong> People with a family history of stomach cancer are at a higher risk.</li>
    </ul>
`;

preventionText.innerHTML = `
    <h3>Stomach Cancer Prevention Tips</h3>
    <ul>
        <li><strong>Helicobacter pylori infection prevention:</strong> Receive treatment for gastritis if necessary.</li>
        <li><strong>Healthy eating habits:</strong> Avoid high-salt, salty foods, and processed foods.</li>
        <li><strong>Regular exercise:</strong> Maintain a healthy weight and exercise regularly.</li>
    </ul>
    <h3>Expert Opinion</h3>
    <p>The early symptoms of stomach cancer are very subtle. However, maintaining a healthy diet and undergoing regular check-ups for early detection is essential for prevention.</p>
`;

// Expert Opinion Video (YouTube Video Example)
expertVideo.innerHTML = `
    <h4>Expert Interview: Stomach Cancer Prevention</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/dLFqbkCDf-o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
           <p>Video provided by: YouTube Apollo Hospitals Cannel</p>
`;

// Gender-based Incidence Data (Stomach Cancer)
const genderData = {
    labels: ['Male', 'Female'],
    datasets: [{
        label: 'Incidence Rate (%)',
        data: [301.2, 145.9], // Incidence rate for men and women
        backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
        borderWidth: 1
    }]
};

const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
new Chart(ctxGender, {
    type: 'pie',  // Pie chart
    data: genderData,
    options: {
        responsive: false,
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                    }
                }
            }
        }
    }
});

// Age-based Incidence Data (Stomach Cancer)
const ageData = {
    labels: ['0-4 years', '5-9 years', '10-14 years', '15-19 years', '20-24 years', '25-29 years', '30-34 years', '35-39 years', '40-44 years', '45-49 years',
             '50-54 years', '55-59 years', '60-64 years', '65-69 years', '70-74 years', '75-79 years', '80-84 years', '85 years and above'],
    datasets: [{
        label: 'Female Incidence Rate (%)',
        data: [0.0, 0.0, 0.0, 0.3, 3.6, 25.1, 92.5, 267.4, 563.9, 942.0, 
               1011.1, 794.0, 808.5, 736.0, 624.7, 489.5, 377.7, 207.3], // Female age-based incidence rates
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
    }, {
        label: 'Male Incidence Rate (%)',
        data: [0.0, 0.0, 0.0, 0.2, 0.5, 2.2, 7.6, 23.6, 66.7, 158.4, 
               268.1, 346.2, 432.7, 520.2, 622.0, 744.5, 834.3, 943.7], // Male age-based incidence rates
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
    }]
};

const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
new Chart(ctxAge, {
    type: 'bar',  // Bar chart
    data: ageData,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toFixed(2) + '%';  // Display percentage
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                    }
                }
            }
        }
    }
});
}







else if (disease === 'lung-cancer') {
    // Gender-based Chart Data (Lung Cancer)
    // Medical Information
    healthTipsContent.innerHTML = `
        <h3>Lung Cancer Medical Information</h3>
        <p><strong>Lung cancer</strong> is a malignant tumor that originates in the lungs. Smoking is the primary cause. In the early stages, symptoms are either absent or mild, but as it progresses, symptoms such as coughing, shortness of breath, chest pain, and weight loss may occur.</p>

        <h3>Stage-wise Symptoms</h3>
        <ul>
            <li><strong>Stage 1:</strong> There may be coughing or shortness of breath, but in most cases, there are few or no symptoms in the early stages.</li>
            <li><strong>Stage 2:</strong> Chest pain, blood in cough, and weight loss may begin to appear.</li>
            <li><strong>Stage 3:</strong> Symptoms such as shortness of breath, persistent cough, and chest pain become more severe, and metastasis to nearby lymph nodes may occur.</li>
            <li><strong>Stage 4:</strong> Metastasis occurs, spreading to other organs, and symptoms like weight loss, fatigue, and severe shortness of breath become more pronounced.</li>
        </ul>

        <h3>Main Causes of Lung Cancer</h3>
        <ul>
            <li><strong>Smoking:</strong> The leading cause of lung cancer, as carcinogens in cigarettes damage lung cells and can lead to cancer.</li>
            <li><strong>Air Pollution:</strong> Fine dust and chemicals in the air may influence the development of lung cancer.</li>
            <li><strong>Genetic Factors:</strong> A family history of lung cancer increases the risk of developing the disease.</li>
            <li><strong>Radiation Exposure:</strong> Exposure to radiation, such as through radiation therapy or radioactive materials, increases the risk of lung cancer.</li>
        </ul>
    `;

    // Prevention Tips
    preventionText.innerHTML = `
        <h3>Lung Cancer Prevention Tips</h3>
        <ul>
            <li><strong>Avoid Smoking:</strong> Smoking is the leading cause of lung cancer, and not smoking is the most important preventive measure.</li>
            <li><strong>Avoid Air Pollution:</strong> Try to minimize exposure to air pollutants, and ventilate indoor spaces regularly to improve air quality.</li>
            <li><strong>Regular Exercise:</strong> Maintaining lung function and a healthy weight through regular exercise is important.</li>
            <li><strong>Regular Check-ups:</strong> Especially for those who have smoked or belong to high-risk groups, regular lung cancer screenings are essential.</li>
        </ul>

        <h3>Expert Opinion</h3>
        <p>Early detection of lung cancer is crucial. Smoking is the biggest risk factor, significantly increasing the likelihood of developing lung cancer. Additionally, air pollution and genetic factors can also play a role, so maintaining a healthy lifestyle and undergoing regular screenings are essential for lung cancer prevention.</p>
    `;

    // Expert Opinion Video
    expertVideo.innerHTML = `
        <h4>Expert Interview: Lung Cancer Prevention</h4>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/FE0gxMkD_3A" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p>Video provided by: YouTube Armando Hasudungan Cannel</p>
    `;

    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [176.4, 116.9], // Lung cancer incidence rates for men and women
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-based Incidence Data (Lung Cancer)
    const ageData = {
        labels: ['0-4 years', '5-9 years', '10-14 years', '15-19 years', '20-24 years', '25-29 years', '30-34 years', '35-39 years', '40-44 years', '45-49 years',
                 '50-54 years', '55-59 years', '60-64 years', '65-69 years', '70-74 years', '75-79 years', '80-84 years', '85 years and above'],
        datasets: [{
            label: 'Female Incidence Rate (%)',
            data: [0.1, 0.0, 0.1, 0.3, 1.4, 2.1, 5.8, 11.1, 23.2, 43.2, 
                   83.4, 161.1, 287.0, 490.2, 655.0, 727.8, 642.2, 367.0], // Female age-based incidence rates
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: 'Male Incidence Rate (%)',
            data: [0.0, 0.1, 0.2, 0.2, 1.5, 1.8, 4.9, 9.5, 21.8, 38.4, 
                   77.3, 168.5, 328.9, 636.4, 929.1, 1100.2, 1050.4, 736.1], // Male age-based incidence rates
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });
}


else if (disease === 'breast-cancer') {
    // Gender Chart Data (Breast Cancer)
    // Medical Information about Breast Cancer
    healthTipsContent.innerHTML = `
    <h3>Breast Cancer Medical Information</h3>
    <p><strong>Breast cancer</strong> is a malignant tumor that occurs in the breast and is one of the most common cancers among women. The early symptoms of breast cancer are minimal or absent, but as it progresses, lumps, pain, or skin changes may appear in the breast.</p>

    <h3>Stage-wise Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> Initially, there are no significant symptoms, and a small lump may be present in the breast. Generally, there is no pain.</li>
        <li><strong>Stage 2:</strong> Pain, skin changes, and an increase in the size of the lump may appear in the breast.</li>
        <li><strong>Stage 3:</strong> The lump grows larger, the skin of the breast becomes red or wrinkled, and lymph node metastasis may occur.</li>
        <li><strong>Stage 4:</strong> The cancer spreads to other parts of the body, causing systemic symptoms and serious health problems.</li>
    </ul>

    <h3>Main Causes of Breast Cancer</h3>
    <ul>
        <li><strong>Genetic Factors:</strong> Genetic mutations like BRCA1, BRCA2 can increase the risk of developing breast cancer.</li>
        <li><strong>Hormonal Factors:</strong> Hormonal changes due to menstruation, pregnancy, and menopause can increase the risk of breast cancer.</li>
        <li><strong>Family History:</strong> If there is a family history of breast cancer, the risk of developing it increases.</li>
        <li><strong>Lifestyle:</strong> Unhealthy lifestyle habits such as a high-fat diet, smoking, and excessive alcohol consumption can increase the risk of breast cancer.</li>
    </ul>
    `;

    // Breast Cancer Prevention Tips
    preventionText.innerHTML = `
    <h3>Breast Cancer Prevention Tips</h3>
    <ul>
        <li><strong>Regular Breast Cancer Screening:</strong> Women over the age of 40 should have regular mammograms.</li>
        <li><strong>Maintain a Healthy Diet:</strong> Avoid high-fat, high-calorie foods, and maintain a balanced diet.</li>
        <li><strong>Regular Exercise:</strong> Regular physical activity helps prevent breast cancer and is important for weight management.</li>
        <li><strong>Avoid Alcohol and Smoking:</strong> Smoking and excessive alcohol consumption increase the risk of breast cancer.</li>
        <li><strong>Breastfeeding:</strong> Breastfeeding may help reduce the risk of breast cancer.</li>
    </ul>

    <h3>Expert Opinion</h3>
    <p>Breast cancer may have minimal early symptoms, so regular screenings are crucial. Women over 40 are encouraged to have regular mammograms. Maintaining a healthy lifestyle is very important to reduce the risk of breast cancer. If you have a family history of breast cancer, it's advisable to consult with a healthcare professional.</p>
    `;

    // Expert Opinion Video
    expertVideo.innerHTML = `
    <h4>Expert Interview: Breast Cancer Prevention</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/DcKoUlkq-tA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>Video provided by: YouTube Cancer Research UK Cannel</p>
    `;

    // Gender-specific Breast Cancer Incidence Rate Data
    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [2.0, 464.2], // Breast cancer incidence rates for male and female
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-specific Breast Cancer Incidence Rate Data
    const ageData = {
        labels: ['0-4 years', '5-9 years', '10-14 years', '15-19 years', '20-24 years', '25-29 years', '30-34 years', '35-39 years', '40-44 years', '45-49 years',
                 '50-54 years', '55-59 years', '60-64 years', '65-69 years', '70-74 years', '75-79 years', '80-84 years', '85 years and older'],
        datasets: [{
            label: 'Female Incidence Rate (%)',
            data: [0.0, 0.0, 0.0, 0.4, 3.7, 26.8, 99.9, 268.7, 584.7, 940.1, 
                   1025.2, 821.4, 812.1, 741.8, 624.9, 481.1, 367.6, 202.5], // Incidence rate for females by age group
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: 'Male Incidence Rate (%)',
            data: [0.0, 0.0, 0.0, 0.1, 0.0, 0.0, 0.0, 0.3, 0.4, 0.9, 
                   2.4, 2.3, 4.6, 5.6, 7.6, 8.7, 9.3, 12.1], // Incidence rate for males by age group
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });
}

else if (disease === 'colon-cancer') {
    // Gender Chart Data (Colon Cancer)
    // Medical Information about Colon Cancer
    healthTipsContent.innerHTML = `
    <h3>Colon Cancer Medical Information</h3>
    <p><strong>Colon cancer</strong> is a malignant tumor that occurs in the colon, and in its early stages, there are often no symptoms. As the cancer progresses, various symptoms such as changes in bowel habits, blood in stool, abdominal pain, and weight loss may occur.</p>

    <h3>Stage-wise Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> Early stages typically show no symptoms, although minor changes in bowel habits may be observed.</li>
        <li><strong>Stage 2:</strong> Discomfort during bowel movements, abdominal pain, and blood in stool may occur.</li>
        <li><strong>Stage 3:</strong> The tumor grows, bowel habit changes continue, and symptoms like weight loss and fatigue may appear.</li>
        <li><strong>Stage 4:</strong> Colon cancer spreads to other organs, leading to symptoms like weight loss, abdominal bloating, extreme fatigue, and systemic symptoms.</li>
    </ul>

    <h3>Main Causes of Colon Cancer</h3>
    <ul>
        <li><strong>Genetic Factors:</strong> A family history of colon cancer can increase the risk of developing the disease.</li>
        <li><strong>Irregular Eating Habits:</strong> A diet high in fat, low in fiber, and the consumption of processed foods can increase the risk of colon cancer.</li>
        <li><strong>Smoking and Alcohol:</strong> Smoking and excessive alcohol consumption can raise the risk of colon cancer.</li>
        <li><strong>Age and Gender:</strong> The risk of colon cancer increases with age, and it is more common in men.</li>
    </ul>
    `;

    // Colon Cancer Prevention Tips
    preventionText.innerHTML = `
    <h3>Colon Cancer Prevention Tips</h3>
    <ul>
        <li><strong>Regular Colon Cancer Screening:</strong> Adults over the age of 50 should regularly undergo colonoscopy exams.</li>
        <li><strong>Maintain a Healthy Diet:</strong> Eat foods rich in fiber (such as fruits, vegetables, and whole grains) and avoid high-fat, high-calorie foods.</li>
        <li><strong>Regular Exercise:</strong> Consistent exercise plays an important role in preventing colon cancer and helps maintain a healthy weight.</li>
        <li><strong>Avoid Smoking and Alcohol:</strong> Smoking and excessive alcohol consumption significantly increase the risk of colon cancer.</li>
        <li><strong>Prevent Obesity:</strong> Maintaining a healthy weight and preventing obesity is important for colon cancer prevention.</li>
    </ul>

    <h3>Expert Opinion</h3>
    <p>Colon cancer often shows minimal symptoms in the early stages, making regular screenings essential. It is recommended that people over the age of 50 undergo regular colonoscopies. Healthy eating habits and regular exercise are crucial in preventing colon cancer. Those with a family history should take extra precautions and undergo more frequent screenings.</p>
    `;

    // Expert Opinion Video
    expertVideo.innerHTML = `
    <h4>Expert Interview: Colon Cancer Prevention</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/cVTeLRdf3eE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>Video provided by: YouTube Osmosis Cannel</p>
    `;

    // Gender-specific Colon Cancer Incidence Rate Data
    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [267.5, 179.6], // Colon cancer incidence rates for male and female
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-specific Colon Cancer Incidence Rate Data
    const ageData = {
        labels: ['0-4 years', '5-9 years', '10-14 years', '15-19 years', '20-24 years', '25-29 years', '30-34 years', '35-39 years', '40-44 years', '45-49 years',
                 '50-54 years', '55-59 years', '60-64 years', '65-69 years', '70-74 years', '75-79 years', '80-84 years', '85 years and older'],
        datasets: [{
            label: 'Female Incidence Rate (%)',
            data: [0.0, 0.0, 0.3, 0.8, 4.0, 12.4, 32.7, 57.4, 97.3, 125.6, 
                   218.8, 301.8, 432.4, 581.3, 704.6, 839.6, 920.0, 813.1], // Female incidence rate by age group
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: 'Male Incidence Rate (%)',
            data: [0.0, 0.0, 0.1, 1.0, 5.3, 13.8, 37.2, 64.6, 106.9, 135.4, 
                   248.6, 371.6, 575.0, 803.8, 961.5, 1127.9, 1246.6, 1200.4], // Male incidence rate by age group
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });
}

else if (disease === 'diabetes') {
    healthTipsContent.innerHTML = `
    <h3>Diabetes Medical Information</h3>
    <p><strong>Diabetes</strong> is a condition where the body has problems controlling blood sugar due to a lack of insulin or insulin resistance. In the early stages, symptoms can be minimal, but if blood sugar remains high for a prolonged period, symptoms such as fatigue, frequent urination, excessive thirst, and weight loss may appear.</p>

    <h3>Stage-wise Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> Initially, there may be no symptoms, but some people may experience extreme thirst or frequent urination.</li>
        <li><strong>Stage 2:</strong> Symptoms such as fatigue, weight loss, and delayed wound healing may develop.</li>
        <li><strong>Stage 3:</strong> Blood sugar control becomes more difficult, and complications such as vision impairment and nerve damage (diabetic neuropathy) may occur.</li>
        <li><strong>Stage 4:</strong> Diabetes progresses, leading to severe complications, including cardiovascular disease, kidney disease, and retinopathy.</li>
    </ul>

    <h3>Main Causes of Diabetes</h3>
    <ul>
        <li><strong>Genetic Factors:</strong> A family history of diabetes increases the likelihood of developing the condition.</li>
        <li><strong>Obesity:</strong> Overweight or obesity is a major risk factor for diabetes.</li>
        <li><strong>Lack of Exercise:</strong> A lack of physical activity negatively impacts blood sugar control, increasing the risk of diabetes.</li>
        <li><strong>Irregular Eating Habits:</strong> Excessive intake of high-carbohydrate and sugary foods can lead to diabetes.</li>
        <li><strong>Age:</strong> The risk of developing diabetes increases with age.</li>
    </ul>
    `;

    // Diabetes Prevention Tips
    preventionText.innerHTML = `
    <h3>Diabetes Prevention Tips</h3>
    <ul>
        <li><strong>Maintain a Healthy Weight:</strong> Keeping a healthy weight and preventing obesity is crucial.</li>
        <li><strong>Regular Exercise:</strong> Engaging in at least 150 minutes of moderate-intensity exercise per week can help prevent diabetes.</li>
        <li><strong>Maintain Healthy Eating Habits:</strong> Avoid excessive sugar and high-carbohydrate foods, and eat vegetables, whole grains, and low-fat proteins.</li>
        <li><strong>Quit Smoking:</strong> Smoking increases the risk of complications from diabetes, so quitting is essential.</li>
        <li><strong>Regular Blood Sugar Monitoring:</strong> It’s important to check blood sugar regularly to detect problems early.</li>
    </ul>

    <h3>Expert Opinion</h3>
    <p>Diabetes may not show symptoms in the early stages, making early detection difficult. Regular health checkups and monitoring blood sugar levels are crucial for managing the condition. Maintaining a healthy lifestyle, particularly managing weight and exercising regularly, can significantly help in preventing diabetes.</p>
    `;

    // Expert Opinion Video
    expertVideo.innerHTML = `
    <h4>Expert Interview: Diabetes Prevention</h4>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/wZAjVQWbMlE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>Video provided by: YouTube Diabetes UK Cannel</p>
    `;

    // Gender-specific Diabetes Incidence Rate Data
    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [14.4, 10.7], // Example: 14.4% for males and 10.7% for females
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-specific Diabetes Incidence Rate Data
    const ageData = {
        labels: ['19-29 years', '30-39 years', '40-49 years', '50-59 years', '60-69 years', '70 years and older'],
        datasets: [{
            label: 'Male Incidence Rate (%)',
            data: [2.8, 3.1, 8.9, 24.1, 25.1, 27.8], // Male incidence rate by age group
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Female Incidence Rate (%)',
            data: [0.2, 2.9, 3.3, 11.1, 16.3, 30.6], // Female incidence rate by age group
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });
}


else if (disease === 'depression') {
    healthTipsContent.innerHTML = `
    <h3>Depression Medical Information</h3>
    <p><strong>Depression</strong> is a mental disorder characterized by persistent sadness, lack of joy, loss of interest, and low energy. Depression can occur for various reasons, and if left untreated, it can seriously affect daily life.</p>

    <h3>Stage-wise Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> Mild sadness, fatigue, anxiety, and similar symptoms may appear.</li>
        <li><strong>Stage 2:</strong> Persistent feelings of depression, sleep issues, changes in appetite, and low self-esteem may emerge.</li>
        <li><strong>Stage 3:</strong> Thoughts of suicide, helplessness, and social isolation may occur, and professional treatment may be necessary.</li>
        <li><strong>Stage 4:</strong> Depression becomes severe, making daily life difficult, and mental health care is essential.</li>
    </ul>

    <h3>Main Causes of Depression</h3>
    <ul>
        <li><strong>Genetic Factors:</strong> A family history of depression can increase the risk of developing it.</li>
        <li><strong>Hormonal Imbalance:</strong> Hormonal changes, particularly those related to female hormones, can increase the risk of depression.</li>
        <li><strong>Stress:</strong> Severe stress or changes in the external environment can trigger depression.</li>
        <li><strong>Social Isolation:</strong> Feelings of isolation or relationship issues can increase the likelihood of developing depression.</li>
    </ul>
    `;

    // Depression Prevention Tips
    preventionText.innerHTML = `
    <h3>Depression Prevention Tips</h3>
    <ul>
        <li><strong>Regular Exercise:</strong> Exercise is effective in preventing depression, improving mood, and relieving stress.</li>
        <li><strong>Healthy Eating Habits:</strong> A balanced diet helps maintain physical health and provides essential nutrients for the brain.</li>
        <li><strong>Social Engagement:</strong> Interacting with friends and family helps avoid social isolation and maintains mental stability.</li>
        <li><strong>Stress Management:</strong> Managing stress and practicing relaxation techniques, such as meditation, is crucial for maintaining mental health.</li>
        <li><strong>Professional Counseling:</strong> It's important to seek professional counseling if depression symptoms persist or worsen.</li>
    </ul>

    <h3>Expert Opinion</h3>
    <p>Depression does not resolve naturally over time. Even if the symptoms are mild, it's important to begin treatment early. Seeking professional counseling is a significant step in preventing and treating depression. Regular exercise, a balanced diet, and social interaction also play important roles in prevention.</p>
    `;

    // Expert Opinion Video
    expertVideo.innerHTML = `
    <h4>Expert Interview: Depression Prevention</h4>
     <iframe width="560" height="315" src="https://www.youtube.com/embed/blwV6rnvDk8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>Video provided by: YouTube Stanford Center for Health Education Cannel</p>
    `;

    // Gender-specific Depression Incidence Rate Data
    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [6.0, 12.0], // Example: 6.0% for males and 12.0% for females
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-specific Depression Incidence Rate Data
    const ageData = {
        labels: ['19-29 years', '30-39 years', '40-49 years', '50-59 years', '60-69 years', '70 years and older'],
        datasets: [{
            label: 'Male Incidence Rate (%)',
            data: [2.5, 4.0, 8.0, 10.0, 12.0, 15.0], // Male incidence rate by age group
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Female Incidence Rate (%)',
            data: [5.0, 7.0, 10.0, 15.0, 18.0, 20.0], // Female incidence rate by age group
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });
}

else if (disease === 'dementia') {
    healthTipsContent.innerHTML = `
    <h3>Dementia Medical Information</h3>
    <p><strong>Dementia</strong> refers to a group of symptoms that affect memory, thinking, problem-solving abilities, and the ability to perform daily activities. It primarily occurs in older adults, but it can also develop in younger people. Dementia symptoms gradually worsen over time.</p>

    <h3>Stage-wise Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> Mild memory decline, occasional forgetfulness in daily tasks may occur.</li>
        <li><strong>Stage 2:</strong> Short-term memory issues become more pronounced, and it may become difficult to remember directions or schedules.</li>
        <li><strong>Stage 3:</strong> Frequent misplacing of objects, difficulty performing daily tasks independently, and problems remembering people's names may emerge.</li>
        <li><strong>Stage 4:</strong> As dementia progresses, cognitive function significantly declines, making independent daily living impossible, and care from family or caregivers is required.</li>
    </ul>

    <h3>Main Causes of Dementia</h3>
    <ul>
        <li><strong>Aging:</strong> The risk of dementia increases with age.</li>
        <li><strong>Genetic Factors:</strong> A family history of dementia can increase the likelihood of developing it.</li>
        <li><strong>Vascular Diseases:</strong> Conditions related to blood vessels, such as hypertension, diabetes, and hyperlipidemia, can contribute to dementia.</li>
        <li><strong>Alzheimer's Disease:</strong> The most common form of dementia, in which brain cells progressively deteriorate, leading to memory and cognitive decline.</li>
    </ul>
    `;

    // Dementia Prevention Tips
    preventionText.innerHTML = `
    <h3>Dementia Prevention Tips</h3>
    <ul>
        <li><strong>Regular Exercise:</strong> Regular physical activity helps maintain brain health and improves blood circulation, which can aid in preventing dementia.</li>
        <li><strong>Healthy Eating Habits:</strong> Eating brain-healthy foods (e.g., fish, nuts, fruits, vegetables) and reducing unhealthy fats and sugars is important.</li>
        <li><strong>Maintaining Mental Activity:</strong> Learning new things, doing puzzles, reading, and other mental exercises help stimulate the brain.</li>
        <li><strong>Social Engagement:</strong> Maintaining social interactions and talking with friends or family can help preserve cognitive function.</li>
        <li><strong>Regular Health Check-ups:</strong> Managing chronic conditions like hypertension, diabetes, and hyperlipidemia is essential for protecting brain health.</li>
    </ul>

    <h3>Expert Opinion</h3>
    <p>Dementia's early symptoms can be subtle and often overlooked, but as symptoms progress, the brain can suffer irreversible damage. Early detection and prevention are crucial, and adopting a healthy lifestyle and undergoing regular check-ups can significantly help prevent dementia.</p>
    `;

    // Expert Opinion Video
    expertVideo.innerHTML = `
    <h4>Expert Interview: Dementia Prevention</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/gKZhp2JNYyI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>Video provided by: YouTube Rhesus Medicine Cannel</p>
    `;

    // Gender-specific Dementia Incidence Rate Data
    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [7.0, 12.5], // Example: 7.0% for males and 12.5% for females
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-specific Dementia Incidence Rate Data
    const ageData = {
        labels: ['60-69 years', '70-79 years', '80-89 years', '90 years and older'],
        datasets: [{
            label: 'Male Incidence Rate (%)',
            data: [5.5, 10.0, 20.0, 25.0], // Male dementia incidence rate by age group
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Female Incidence Rate (%)',
            data: [7.0, 12.5, 22.0, 28.0], // Female dementia incidence rate by age group
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });
}

else if (disease === 'stroke') {
    healthTipsContent.innerHTML = `
    <h3>Stroke Medical Information</h3>
    <p><strong>Stroke</strong> refers to a condition where the blood flow to the brain is blocked or there is bleeding, causing brain cells to be damaged. A stroke can occur very suddenly, and immediate treatment is required when symptoms appear. Common symptoms include paralysis of one arm or leg, speech difficulties, vision problems, and sudden headaches.</p>

    <h3>Stage-wise Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> Sudden paralysis or numbness in the arms or legs, and speech difficulties (e.g., slurred or hard-to-understand speech) may occur.</li>
        <li><strong>Stage 2:</strong> As symptoms worsen, confusion, severe headaches, vision problems, and memory decline may appear.</li>
        <li><strong>Stage 3:</strong> Paralysis may persist in certain body parts, and it becomes difficult to perform daily tasks independently. If the condition worsens, consciousness problems may arise.</li>
        <li><strong>Stage 4:</strong> When the stroke is severe, bodily functions may be completely lost, and it becomes difficult to perform daily activities independently. Emergency medical intervention is needed.</li>
    </ul>

    <h3>Main Causes of Stroke</h3>
    <ul>
        <li><strong>High Blood Pressure:</strong> High blood pressure is the leading risk factor for stroke. If not properly managed, it can strain the brain's blood vessels and trigger a stroke.</li>
        <li><strong>Diabetes:</strong> Diabetes damages blood vessels, increasing the risk of stroke.</li>
        <li><strong>Smoking:</strong> Smoking narrows blood vessels and raises blood pressure, significantly increasing the likelihood of a stroke.</li>
        <li><strong>Hyperlipidemia:</strong> High cholesterol or hyperlipidemia can accelerate arteriosclerosis, raising the risk of stroke.</li>
        <li><strong>Genetic Factors:</strong> If someone in your family has had a stroke, your risk may be higher.</li>
    </ul>
    `;

    // Stroke Prevention Tips
    preventionText.innerHTML = `
    <h3>Stroke Prevention Tips</h3>
    <ul>
        <li><strong>Healthy Diet:</strong> It's important to consume low-sodium, low-fat foods and ensure sufficient intake of fruits and vegetables.</li>
        <li><strong>Regular Exercise:</strong> Daily aerobic exercise for about 30 minutes helps improve circulation and maintain cardiovascular health.</li>
        <li><strong>Quit Smoking:</strong> Smoking greatly increases the risk of stroke. Quitting smoking can help prevent it.</li>
        <li><strong>Weight Management:</strong> Being overweight increases the risk of stroke, so maintaining a healthy weight is important.</li>
        <li><strong>Regular Health Check-ups:</strong> Managing chronic conditions like high blood pressure, diabetes, and hyperlipidemia, as well as regularly checking blood pressure and undergoing blood tests, can help prevent stroke.</li>
    </ul>

    <h3>Expert Opinion</h3>
    <p>Stroke is a time-critical condition. It is important to seek medical attention immediately if symptoms appear, as delays in treatment can result in severe complications. Managing chronic diseases such as high blood pressure and diabetes, quitting smoking, and adopting a healthy diet and exercise routine are key preventive measures.</p>
    `;

    // Expert Opinion Video
    expertVideo.innerHTML = `
    <h4>Expert Interview: Stroke Prevention</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/7lpqxDEfszY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>Video provided by: YouTube Ninja Nerd Cannel</p>
    `;

    // Gender-specific Stroke Incidence Rate Data
    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [5.2, 4.1], // Example: Male 5.2%, Female 4.1%
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-specific Stroke Incidence Rate Data
    const ageData = {
        labels: ['30-39 years', '40-49 years', '50-59 years', '60-69 years', '70-79 years', '80 years and older'],
        datasets: [{
            label: 'Male Incidence Rate (%)',
            data: [0.5, 2.0, 4.5, 9.0, 18.5, 27.0], // Male stroke incidence rate by age group
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Female Incidence Rate (%)',
            data: [0.4, 1.5, 3.8, 7.5, 16.0, 25.0], // Female stroke incidence rate by age group
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });
}

else if (disease === 'hypertension') {
    healthTipsContent.innerHTML = `
    <h3>Hypertension Medical Information</h3>
    <p><strong>Hypertension</strong> refers to a condition where blood pressure is consistently high. Hypertension puts a strain on the heart and blood vessels, and over time, it can lead to serious complications such as heart disease, stroke, and kidney disease. Often called the "silent killer," hypertension may not present symptoms in its early stages, making regular blood pressure monitoring essential for early detection and management.</p>

    <h3>Stage-wise Symptoms</h3>
    <ul>
        <li><strong>Stage 1:</strong> The initial symptoms of hypertension may be subtle, such as occasional headaches or dizziness.</li>
        <li><strong>Stage 2:</strong> As symptoms worsen, chest pain, difficulty breathing, and irregular heartbeats may appear.</li>
        <li><strong>Stage 3:</strong> If hypertension persists, it can damage vital organs like the heart, kidneys, and brain, leading to complications.</li>
        <li><strong>Stage 4:</strong> Severe complications from hypertension may lead to heart attack, stroke, or kidney failure.</li>
    </ul>

    <h3>Major Causes of Hypertension</h3>
    <ul>
        <li><strong>Genetic Factors:</strong> A family history of hypertension increases the risk of developing the condition.</li>
        <li><strong>Irregular Eating Habits:</strong> A diet high in salt, excessive alcohol consumption, and high-fat foods are major contributors to hypertension.</li>
        <li><strong>Lack of Exercise:</strong> A sedentary lifestyle can increase blood pressure.</li>
        <li><strong>Obesity:</strong> Being overweight or obese increases the risk of hypertension.</li>
        <li><strong>Stress:</strong> Chronic stress can raise blood pressure.</li>
    </ul>
    `;

    // Hypertension Prevention Tips
    preventionText.innerHTML = `
    <h3>Hypertension Prevention Tips</h3>
    <ul>
        <li><strong>Healthy Diet:</strong> It is important to eat a low-sodium, low-fat diet and increase the intake of fruits, vegetables, and whole grains.</li>
        <li><strong>Regular Exercise:</strong> Engaging in at least 30 minutes of aerobic exercise daily helps lower blood pressure.</li>
        <li><strong>Quit Smoking:</strong> Smoking raises blood pressure and damages blood vessels, so quitting smoking is essential.</li>
        <li><strong>Stress Management:</strong> Since stress can elevate blood pressure, using relaxation techniques or meditation can help manage stress.</li>
        <li><strong>Regular Blood Pressure Checks:</strong> Since hypertension may not have obvious symptoms, it is important to regularly check your blood pressure for early detection and management.</li>
    </ul>

    <h3>Expert Opinion</h3>
    <p>Hypertension can lead to serious complications over time, so early detection and consistent management are crucial. Maintaining a healthy lifestyle, regular exercise, and a balanced diet are key to controlling blood pressure. Regularly monitoring your blood pressure will help protect your health.</p>
    `;

    // Expert Opinion Video
    expertVideo.innerHTML = `
    <h4>Expert Interview: Hypertension Management</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/Pr37kQIbqs4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>Video provided by: YouTube Mass General Brigham Cannel</p>
    `;

    // Gender-specific Hypertension Incidence Data
    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Incidence Rate (%)',
            data: [30.5, 28.7], // Example: Male 30.5%, Female 28.7%
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // Pie chart
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });

    // Age-specific Hypertension Incidence Data
    const ageData = {
        labels: ['19-29 years', '30-39 years', '40-49 years', '50-59 years', '60-69 years', '70 years and older'],
        datasets: [{
            label: 'Male Incidence Rate (%)',
            data: [5.5, 10.0, 20.3, 33.8, 45.1, 53.7], // Male hypertension incidence by age group
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Female Incidence Rate (%)',
            data: [3.2, 9.5, 18.7, 32.4, 42.3, 50.9], // Female hypertension incidence by age group
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // Bar chart
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // Display percentage
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // Display incidence rate
                        }
                    }
                }
            }
        }
    });
}
}












    </script>
</body>
</html>
