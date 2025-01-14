

<?php
session_start(); 


$userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : '이름없음'; 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>동의대 웹서버 팀프로젝트</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

    <div class="container">
        
        <aside class="sidebar">
            <div class="user-info">
                <h3>로그인 정보</h3>
                <p>사용자 이름: <?php echo htmlspecialchars($userName); ?></p>
            </div>

            <hr> 
            
            <br>
                <h2>건강 지표</h2>
                <ul id="disease-list">
                    
                    <li onclick="toggleSubMenu('cancer-menu', this)">암 검사<span class="toggle-icon plus-icon"></span></li>
<ul id="cancer-menu" class="sub-menu">
    <li onclick="showIndicators('liver-cancer')">간암</li>
    <li onclick="showIndicators('stomach-cancer')">위암</li>
    <li onclick="showIndicators('lung-cancer')">폐암</li>
    <li onclick="showIndicators('breast-cancer')">유방암</li>
    <li onclick="showIndicators('colon-cancer')">대장암</li>
</ul>
    
                    
                    <li onclick="showIndicators('diabetes')">당뇨병</li>
    
                   
                    <li onclick="toggleSubMenu('brain-disease-menu', this)">뇌 질환<span class="toggle-icon plus-icon"></span></li>
                    <ul id="brain-disease-menu" class="sub-menu">
                        <li onclick="showIndicators('depression')">우울증</li>
                        <li onclick="showIndicators('dementia')">치매</li>
                        <li onclick="showIndicators('stroke')">뇌졸중(중풍)</li>
                    </ul>
    
                    
                    <li onclick="showIndicators('hypertension')">고혈압</li>
                </ul>


                <hr>
                <div class="health-check-info">
                <h3>2024년 건강검진 무료 대상자</h3>
<ul>
    <li><strong>40세 이상 남성, 45세 이상 여성:</strong> 매년 무료.</li>
    <li><strong>2024년 짝수년도:</strong> 짝수년도 대상자.</li>
    <li><strong>20대/30대:</strong> 고위험군은 검사 가능.</li>
    <li><strong>고위험군:</strong> 나이에 상관없이 무료.</li>
</ul>
<p><a href="https://www.nhis.or.kr/nhis/index.do" target="_blank" class="healthcheck-link">신청 바로가기</a></p>

        </aside>

        
        <div class="dashboard-content">
            <header>
                <h1>동의대학교 2학년 웹프로젝트 (HTML, CSS, JS, PHP, MySQL 기반 대시보드)</h1>
                <button id="back-btn" class="back-btn">뒤로가기</button>
                <select id="language-select" onchange="changeLanguage()">
                    <option value="ko">한국어</option>
                    <option value="en">English</option>
                    
                </select>
            </header>

           
            <section class="analysis-section" >
                <h2>매년 건강검진 참여율</h2>
               
                <div class="charts">
                    <div class="chart" id="weight-chart">
                    <h3>성별</h3>

                
                        <canvas id="gender-chart"></canvas> 
                    </div>
                    <div class="chart" id="blood-pressure-chart">
                        <h3>나이별</h3>
                        <canvas id="age-group-chart"></canvas> 
                    </div>
                   
                </div>
            </section>
        


            <section class="analysis-section">
    <h2>질병 발병률</h2>
    <div class="charts">
        <div class="chart" id="disease-gender-chart">
            <h3>성별</h3>
            
            <canvas id="disease-gender-chart-canvas" width="450" height="300"></canvas> 
        </div>
        <div class="chart" id="disease-age-chart">
            <h3>나이별</h3>
            <canvas id="disease-age-chart-canvas"></canvas> 
        </div>
    </div>
</section>
            
           

           
            <section class="health-tips">
                <h2>질병 개요</h2>
                <div id="health-tips-content">
                    <p>이 섹션에서는 해당 질병에 대한 주요 증상, 발생원인 및 부위 등 유용한 정보를 제공합니다.</p>
                </div>
            </section>

           
            <section class="goal-setting">
                <h2>예방수칙 및 전문가의 소견</h2>
                <div class="goal-content">
                <p id="prevention-tips">건강한 삶을 위한 전문가의 예방 수칙과 소견을 제공합니다.</p>
                <div id="expert-opinion-video"></div>
                </div>
            </section>


          
            <div class="footer">
                <p>© 2024 Health Report Dashboard</p>
                <p>Dong-eui University</p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

    <script>
       
        function toggleSubMenu(menuId, liElement) {
            var menu = document.getElementById(menuId);
            var icon = liElement.querySelector('.toggle-icon');
            
          
            if (menu.style.display === "block") {
                menu.style.display = "none";
                menu.style.maxHeight = "0";
                icon.classList.remove('minus-icon');
                icon.classList.add('plus-icon');
            } else {
                menu.style.display = "block";
                menu.style.maxHeight = menu.scrollHeight + "px";  
                icon.classList.remove('plus-icon');
                icon.classList.add('minus-icon');
            }
        }

       

   
function changeLanguage() {
   
    const selectedLanguage = document.getElementById('language-select').value;
    
  
    if (selectedLanguage === 'en') {
        window.location.href = 'main-English.php';
    } 
}







        const genderData = {
    labels: ['남자', '여자'], 
    datasets: [{
        label: '참여율 (%)',
        data: [
            (8907506 / 11697034) * 100, 
            (8325757 / 11164598) * 100  
        ], 
        backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 99, 132, 0.6)'],
        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'], 
        borderWidth: 1
    }]
};

const ctxGender = document.getElementById('gender-chart').getContext('2d');
const genderChart = new Chart(ctxGender, {
    type: 'bar', 
    data: genderData,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toFixed(2) + '%'; 
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: true, 
                position: 'top', 
                labels: {
                    generateLabels: function(chart) {
                        
                        const labels = chart.data.datasets[0].data;
                        return chart.data.labels.map(function(label, index) {
                            return {
                                text: label, 
                                fillStyle: chart.data.datasets[0].backgroundColor[index], 
                                strokeStyle: chart.data.datasets[0].borderColor[index], 
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
    labels: ['19세 이하', '20 ~ 24세', '25 ~ 29세', '30 ~ 34세', '35 ~ 39세', '40 ~ 44세', '45 ~ 49세'],
    datasets: [
        {
            label: '남자',
            data: [
                (7631 / 9291) * 100,  
                (254753 / 565328) * 100,  
                (642198 / 839912) * 100,  // 25 ~ 29세 남자 참여율
                (857859 / 1094158) * 100,  // 30 ~ 34세 남자 참여율
                (775304 / 960742) * 100,  // 35 ~ 39세 남자 참여율
                (1126201 / 1371584) * 100,  // 40 ~ 44세 남자 참여율
                (928604 / 1138381) * 100   // 45 ~ 49세 남자 참여율
            ],
            backgroundColor: 'rgba(54, 162, 235, 0.6)', // 남자 색상
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },
        {
            label: '여자',
            data: [
                (4727 / 6244) * 100,  // 19세 이하 여자 참여율
                (369882 / 635982) * 100,  // 20 ~ 24세 여자 참여율
                (606400 / 758569) * 100,  // 25 ~ 29세 여자 참여율
                (674357 / 899077) * 100,  // 30 ~ 34세 여자 참여율
                (526460 / 720894) * 100,  // 35 ~ 39세 여자 참여율
                (906829 / 1168862) * 100,  // 40 ~ 44세 여자 참여율
                (767139 / 967460) * 100   // 45 ~ 49세 여자 참여율
            ],
            backgroundColor: 'rgba(255, 99, 132, 0.6)', // 여자 색상
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }
    ]
};
const ctxAge = document.getElementById('age-group-chart').getContext('2d');
const ageGroupChart = new Chart(ctxAge, {
    type: 'bar', // 막대 그래프
    data: ageData,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toFixed(2) + '%'; // 퍼센트로 표시
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
    // 성별 차트 데이터 (간암)
    healthTipsContent.innerHTML = `
    <h3>간암 의학 정보</h3>
    <p><strong>간암</strong>은 간에서 발생하는 악성 종양으로, 간염, 간경변, 과도한 음주 등으로 인해 발생할 수 있습니다. 초기에는 증상이 거의 없으며, 진행되면 피로감, 복부 팽만감, 황달 등의 증상이 나타날 수 있습니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 증상이 거의 없고, 일부 환자는 피로감을 느낄 수 있습니다.</li>
        <li><strong>2단계:</strong> 체중 감소, 식욕 부진, 구토, 오른쪽 상복부 통증 등이 발생할 수 있습니다.</li>
        <li><strong>3단계:</strong> 황달, 복부 팽만감, 구토, 배변 시 출혈 등이 나타날 수 있으며, 간 기능 저하가 심해질 수 있습니다.</li>
        <li><strong>4단계:</strong> 전이가 발생하며, 체중 감소와 전신적인 증상이 심각해질 수 있습니다. 간 외 다른 장기로의 전이가 이루어집니다.</li>
    </ul>

    <h3>간암의 주요 발생 원인</h3>
    <ul>
        <li><strong>간염 바이러스 (B형, C형):</strong> 간염은 간암의 주요 원인 중 하나로, 특히 만성 간염은 간암 발병 위험을 높입니다.</li>
        <li><strong>과도한 음주:</strong> 장기간 과도한 음주는 간경변을 일으킬 수 있으며, 이는 간암으로 발전할 수 있습니다.</li>
        <li><strong>간경변:</strong> 간경변은 간세포가 손상되어 간 기능이 떨어지는 질환으로, 간암 발생의 주요 원인입니다.</li>
        <li><strong>비알콜성 지방간질환:</strong> 비알콜성 지방간질환은 비만, 당뇨병 등과 관련이 있으며, 간암으로 발전할 수 있습니다.</li>
        <li><strong>유전적 요인:</strong> 간암은 가족력이 있는 사람에게 더 흔하게 발생할 수 있습니다.</li>
    </ul>
`;

preventionText.innerHTML = `
    <h3>간암 예방 수칙</h3>
    <ul>
        <li><strong>간염 예방:</strong> B형 간염과 C형 간염 백신을 접종하고, 간염이 있을 경우 치료를 받으세요.</li>
        <li><strong>건강한 식습관:</strong> 과도한 음주를 피하고, 신선한 채소와 과일을 충분히 섭취하며, 고지방, 고열량 음식을 줄이세요.</li>
        <li><strong>규칙적인 운동:</strong> 비만을 예방하고 체중을 관리하며, 정기적으로 운동을 하세요.</li>
        <li><strong>간경변 예방:</strong> 간경변은 간암으로 이어질 수 있으므로, 알콜 섭취를 줄이고, 간 질환에 대한 치료를 받으세요.</li>
        <li><strong>정기적인 건강 검진:</strong> 간암은 초기 증상이 없으므로 정기적인 검진을 통해 간 건강을 체크하세요.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>간암은 초기 증상이 거의 없고, 진행되기 전에는 자각할 수 있는 신호가 적습니다. 따라서, 정기적인 건강 검진과 간염 백신 접종, 건강한 식습관과 운동 습관을 유지하는 것이 간암 예방에 매우 중요합니다. 또한, 간 질환이 있을 경우 조기에 치료를 받는 것이 필수적입니다.</p>
`;

expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 간암 예방</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/O1SsZ3X1_Y8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <p>영상 제공 : 유튜브 아주대병원TV 채널 </p>
`;

    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [115.3, 37.8], // 남자와 여자의 간암 발병률
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (간암)
    const ageData = {
        labels: ['0-4세', '5-9세', '10-14세', '15-19세', '20-24세', '25-29세', '30-34세', '35-39세', '40-44세', '45-49세',
                 '50-54세', '55-59세', '60-64세', '65-69세', '70-74세', '75-79세', '80-84세', '85세 이상'],
        datasets: [{
            label: '여성 발병률 (%)',
            data: [3.2, 0.7, 0.4, 0.4, 0.6, 0.9, 2.5, 8.4, 21.3, 38.6, 
                   76.2, 121.8, 179.0, 229.9, 267.0, 274.5, 248.5, 146.6], // 여성 나이대별 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: '남성 발병률 (%)',
            data: [3.9, 0.4, 0.4, 0.4, 0.9, 0.6, 3.1, 10.3, 31.2, 60.8, 
                   123.1, 199.0, 292.1, 365.0, 412.0, 434.3, 414.9, 294.3], // 남성 나이대별 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}

    
    // 위암 데이터
    else if (disease === 'stomach-cancer') {


        healthTipsContent.innerHTML = `
                <h3>위암 의학 정보</h3>
<p><strong>위암</strong>은 위장에서 발생하는 악성 종양으로, 초기에는 거의 증상이 없으며, 진행되면 속쓰림, 체중 감소, 구토, 혈변 등의 증상이 나타날 수 있습니다.</p>

<h3>단계별 증상</h3>
<ul>
    <li><strong>1단계:</strong> 특별한 증상이 없으며, 가끔 속쓰림이 있을 수 있습니다.</li>
    <li><strong>2단계:</strong> 체중 감소, 식사 후 불편함, 위장 통증, 구토 등이 발생할 수 있습니다.</li>
    <li><strong>3단계:</strong> 구토, 혈변, 복통, 빠른 포만감 등이 나타나며, 암이 주변 조직으로 퍼질 수 있습니다.</li>
    <li><strong>4단계:</strong> 전이가 발생하여 다른 장기로 퍼지며, 심각한 체중 감소와 전신적인 증상이 발생할 수 있습니다.</li>
</ul>

<h3>위암의 주요 발생 원인</h3>
<ul>
    <li><strong>헬리코박터 파일로리 감염:</strong> 위염을 일으키는 세균으로, 위암 발생의 주요 원인입니다.</li>
    <li><strong>식습관:</strong> 고염식, 짠 음식, 탄 음식, 가공식품의 섭취가 위암의 위험을 증가시킵니다.</li>
    <li><strong>흡연과 음주:</strong> 흡연과 과도한 음주는 위암 발생 위험을 높입니다.</li>
    <li><strong>유전적 요인:</strong> 가족력이 있는 사람은 위암에 걸릴 확률이 높습니다.</li>
</ul>
            `;
            preventionText.innerHTML = `
            <h3>위암 예방 수칙</h3>
            <ul>
                <li><strong>헬리코박터 파일로리 감염 예방:</strong> 위염 치료와 관련된 치료를 받으세요.</li>
                <li><strong>건강한 식습관:</strong> 고염식과 짠 음식, 가공식품을 피하세요.</li>
                <li><strong>규칙적인 운동:</strong> 적절한 체중을 유지하고 규칙적인 운동을 하세요.</li>
            </ul>
            <h3>전문가의 소견</h3>
            <p>위암의 초기 증상은 매우 미미합니다. 그러나 예방을 위한 건강한 식습관과 정기적인 검진이 중요합니다.</p>
        `;

        // 전문가의 소견 영상 (유튜브 영상 예시)
        expertVideo.innerHTML = `
            <h4>전문가 인터뷰: 위암 예방</h4>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/Y5Nql4e1MzQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<p>영상 제공 :유튜브 세브란스 채널 </p>
        `;
            
    // 성별 차트 데이터 (위암)
    
    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [301.2, 145.9], // 남자와 여자의 위암 발병률
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
          
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (위암)
    const ageData = {
        labels: ['0-4세', '5-9세', '10-14세', '15-19세', '20-24세', '25-29세', '30-34세', '35-39세', '40-44세', '45-49세',
                 '50-54세', '55-59세', '60-64세', '65-69세', '70-74세', '75-79세', '80-84세', '85세 이상'],
        datasets: [{
            label: '여성 발병률 (%)',
            data: [0.0, 0.0, 0.0, 0.3, 3.6, 25.1, 92.5, 267.4, 563.9, 942.0, 
                   1011.1, 794.0, 808.5, 736.0, 624.7, 489.5, 377.7, 207.3], // 여성 나이대별 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: '남성 발병률 (%)',
            data: [0.0, 0.0, 0.0, 0.2, 0.5, 2.2, 7.6, 23.6, 66.7, 158.4, 
                   268.1, 346.2, 432.7, 520.2, 622.0, 744.5, 834.3, 943.7], // 남성 나이대별 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}






    else if (disease === 'lung-cancer') {
    // 성별 차트 데이터 (폐암)
    // 의학 정보
healthTipsContent.innerHTML = `
    <h3>폐암 의학 정보</h3>
    <p><strong>폐암</strong>은 폐에서 발생하는 악성 종양으로, 주로 흡연이 주요 원인으로 꼽힙니다. 초기에는 증상이 거의 없거나 미미하지만, 진행되면 기침, 호흡 곤란, 가슴 통증, 체중 감소 등의 증상이 나타날 수 있습니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 기침이나 호흡곤란이 있을 수 있지만, 대부분 초기에는 증상이 거의 없습니다.</li>
        <li><strong>2단계:</strong> 가슴 통증, 기침에 혈담이 섞일 수 있으며, 체중 감소가 시작될 수 있습니다.</li>
        <li><strong>3단계:</strong> 호흡곤란, 지속적인 기침, 흉통 등의 증상이 심화되며, 주변 림프절로 전이가 일어날 수 있습니다.</li>
        <li><strong>4단계:</strong> 전이가 발생하여 다른 장기로 퍼지며, 체중 감소, 피로감, 호흡곤란 등이 심각해집니다.</li>
    </ul>

    <h3>폐암의 주요 발생 원인</h3>
    <ul>
        <li><strong>흡연:</strong> 폐암의 가장 큰 원인으로, 담배에 포함된 발암 물질이 폐 세포를 손상시켜 암을 유발할 수 있습니다.</li>
        <li><strong>환경 오염:</strong> 대기 중의 미세먼지, 화학 물질 등이 폐암 발생에 영향을 미칠 수 있습니다.</li>
        <li><strong>유전적 요인:</strong> 가족력이 있을 경우 폐암 발병 위험이 증가할 수 있습니다.</li>
        <li><strong>방사선 노출:</strong> 방사선 치료나 방사선 물질에 노출될 경우 폐암 발생 위험이 커질 수 있습니다.</li>
    </ul>
`;

// 예방 수칙
preventionText.innerHTML = `
    <h3>폐암 예방 수칙</h3>
    <ul>
        <li><strong>흡연을 피하세요:</strong> 흡연이 폐암의 가장 큰 원인으로, 흡연을 하지 않는 것이 가장 중요한 예방책입니다.</li>
        <li><strong>환경 오염 피하기:</strong> 대기 중 오염물질에 노출되지 않도록 하고, 실내 공기를 자주 환기시켜 주세요.</li>
        <li><strong>정기적인 운동:</strong> 운동을 통해 폐 기능을 유지하고, 건강한 체중을 유지하는 것이 중요합니다.</li>
        <li><strong>정기적인 검진:</strong> 특히 흡연 경험이 있거나 고위험군에 속하는 사람은 정기적으로 폐암 검사를 받아야 합니다.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>폐암은 조기 발견이 매우 중요합니다. 흡연이 가장 큰 위험 요소로, 흡연자에게 폐암 발병 위험이 크게 증가합니다. 또한, 대기 오염과 유전적인 요인도 영향을 미칠 수 있으므로, 폐암 예방을 위해서는 건강한 생활습관을 유지하고, 정기적인 검진을 받는 것이 필수적입니다.</p>
`;

// 전문가의 소견 영상
expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 폐암 예방</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/85hBSaWW_iY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>영상 제공 :유튜브 서울대병원tv 채널 </p>
`;

    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [176.4, 116.9], // 남자와 여자의 폐암 발병률
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (폐암)
    const ageData = {
        labels: ['0-4세', '5-9세', '10-14세', '15-19세', '20-24세', '25-29세', '30-34세', '35-39세', '40-44세', '45-49세',
                 '50-54세', '55-59세', '60-64세', '65-69세', '70-74세', '75-79세', '80-84세', '85세 이상'],
        datasets: [{
            label: '여성 발병률 (%)',
            data: [0.1, 0.0, 0.1, 0.3, 1.4, 2.1, 5.8, 11.1, 23.2, 43.2, 
                   83.4, 161.1, 287.0, 490.2, 655.0, 727.8, 642.2, 367.0], // 여성 나이대별 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: '남성 발병률 (%)',
            data: [0.0, 0.1, 0.2, 0.2, 1.5, 1.8, 4.9, 9.5, 21.8, 38.4, 
                   77.3, 168.5, 328.9, 636.4, 929.1, 1100.2, 1050.4, 736.1], // 남성 나이대별 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}

else if (disease === 'breast-cancer') {
    // 성별 차트 데이터 (유방암)
    // 유방암 의학 정보
healthTipsContent.innerHTML = `
    <h3>유방암 의학 정보</h3>
    <p><strong>유방암</strong>은 유방에서 발생하는 악성 종양으로, 여성에게 가장 많이 발생하는 암 중 하나입니다. 유방암의 초기 증상은 거의 없거나 미미하지만, 진행되면 유방에 덩어리나 통증, 피부 변화 등이 나타날 수 있습니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 초기에는 특별한 증상이 없으며, 유방에 작은 덩어리가 있을 수 있습니다. 일반적으로 통증은 없습니다.</li>
        <li><strong>2단계:</strong> 유방에 통증, 피부 변화, 덩어리의 크기 증가 등이 나타날 수 있습니다.</li>
        <li><strong>3단계:</strong> 덩어리가 커지고, 유방의 피부가 붉어지거나 주름이 생기며, 림프절 전이가 발생할 수 있습니다.</li>
        <li><strong>4단계:</strong> 유방암이 전신으로 전이되며, 다른 장기로 퍼지게 되어 전신적인 증상과 심각한 건강 문제가 발생할 수 있습니다.</li>
    </ul>

    <h3>유방암의 주요 발생 원인</h3>
    <ul>
        <li><strong>유전적 요인:</strong> BRCA1, BRCA2 유전자 돌연변이 등 유전적인 요인이 유방암의 발병 위험을 증가시킬 수 있습니다.</li>
        <li><strong>호르몬 요인:</strong> 생리적, 임신, 폐경 등의 호르몬 변화가 유방암의 위험을 높일 수 있습니다.</li>
        <li><strong>가족력:</strong> 유방암 가족력이 있을 경우 발병 위험이 높아질 수 있습니다.</li>
        <li><strong>생활 습관:</strong> 고지방 식단, 흡연, 음주 등 불규칙한 생활 습관은 유방암 발생 위험을 높일 수 있습니다.</li>
    </ul>
`;

// 유방암 예방 수칙
preventionText.innerHTML = `
    <h3>유방암 예방 수칙</h3>
    <ul>
        <li><strong>정기적인 유방암 검진:</strong> 40세 이상 여성은 정기적으로 유방 촬영 검사(유방촬영술)를 받아야 합니다.</li>
        <li><strong>건강한 식습관 유지:</strong> 고지방, 고칼로리 음식을 피하고, 균형 잡힌 식사를 유지하세요.</li>
        <li><strong>규칙적인 운동:</strong> 꾸준한 운동은 유방암 예방에 도움이 되며, 체중 관리에 중요합니다.</li>
        <li><strong>술과 담배 피하기:</strong> 흡연과 과도한 음주는 유방암의 발병 위험을 증가시킵니다.</li>
        <li><strong>모유 수유:</strong> 모유 수유는 유방암 예방에 도움이 될 수 있습니다.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>유방암은 초기 증상이 미미할 수 있어 정기적인 검진이 매우 중요합니다. 여성의 경우, 40세 이후부터 유방촬영술을 정기적으로 받는 것이 권장됩니다. 또한, 유방암의 위험 요소를 줄이기 위해 건강한 생활습관을 유지하는 것이 예방에 매우 중요한 요소입니다. 가족력이 있는 경우, 전문가의 상담을 받는 것이 좋습니다.</p>
`;

// 전문가의 소견 영상
expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 유방암 예방</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/h8Y9rnkDYyE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>영상 제공 :유튜브 세브란스 채널 </p>
        
`;

    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [2.0, 464.2], // 남자와 여자의 유방암 발병률
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (유방암)
    const ageData = {
        labels: ['0-4세', '5-9세', '10-14세', '15-19세', '20-24세', '25-29세', '30-34세', '35-39세', '40-44세', '45-49세',
                 '50-54세', '55-59세', '60-64세', '65-69세', '70-74세', '75-79세', '80-84세', '85세 이상'],
        datasets: [{
            label: '여성 발병률 (%)',
            data: [0.0, 0.0, 0.0, 0.4, 3.7, 26.8, 99.9, 268.7, 584.7, 940.1, 
                   1025.2, 821.4, 812.1, 741.8, 624.9, 481.1, 367.6, 202.5], // 여성 나이대별 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: '남성 발병률 (%)',
            data: [0.0, 0.0, 0.0, 0.1, 0.0, 0.0, 0.0, 0.3, 0.4, 0.9, 
                   2.4, 2.3, 4.6, 5.6, 7.6, 8.7, 9.3, 12.1], // 남성 나이대별 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}
else if (disease === 'colon-cancer') {
    // 성별 차트 데이터 (대장암)
    // 대장암 의학 정보
healthTipsContent.innerHTML = `
    <h3>대장암 의학 정보</h3>
    <p><strong>대장암</strong>은 대장에서 발생하는 악성 종양으로, 초기에는 특별한 증상이 없는 경우가 많습니다. 대장암이 진행되면 배변 습관 변화, 혈변, 복통, 체중 감소 등 다양한 증상이 나타날 수 있습니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 초기에는 증상이 거의 없으며, 배변 습관의 미세한 변화가 있을 수 있습니다.</li>
        <li><strong>2단계:</strong> 배변 시 불편함, 복통, 혈변 등의 증상이 발생할 수 있습니다.</li>
        <li><strong>3단계:</strong> 종양이 커지고, 배변 습관의 변화가 지속되며, 체중 감소와 피로감 등이 나타날 수 있습니다.</li>
        <li><strong>4단계:</strong> 대장암이 다른 장기로 전이되며, 체중 감소, 복부 팽만감, 극심한 피로 등이 나타나며 전신적인 증상이 발생할 수 있습니다.</li>
    </ul>

    <h3>대장암의 주요 발생 원인</h3>
    <ul>
        <li><strong>유전적 요인:</strong> 대장암 가족력이 있는 경우 발병 위험이 증가할 수 있습니다.</li>
        <li><strong>불규칙한 식습관:</strong> 고지방, 저섬유질 식단, 가공식품 섭취 등이 대장암의 발병 위험을 높일 수 있습니다.</li>
        <li><strong>흡연과 음주:</strong> 흡연과 과도한 음주는 대장암 발병 위험을 높입니다.</li>
        <li><strong>나이와 성별:</strong> 나이가 많을수록 대장암 발병 확률이 높아지며, 남성에서 더 많이 발생합니다.</li>
    </ul>
`;

// 대장암 예방 수칙
preventionText.innerHTML = `
    <h3>대장암 예방 수칙</h3>
    <ul>
        <li><strong>정기적인 대장암 검진:</strong> 50세 이상의 성인은 정기적인 대장 내시경 검사를 받는 것이 중요합니다.</li>
        <li><strong>건강한 식습관 유지:</strong> 섬유질이 풍부한 식품(과일, 채소, 통곡물)을 섭취하고, 고지방, 고칼로리 음식을 피하세요.</li>
        <li><strong>규칙적인 운동:</strong> 꾸준한 운동은 대장암 예방에 중요한 역할을 하며, 건강한 체중을 유지하는 데 도움이 됩니다.</li>
        <li><strong>흡연과 음주 피하기:</strong> 흡연과 과도한 음주는 대장암 발병 위험을 크게 증가시킵니다.</li>
        <li><strong>비만 예방:</strong> 적절한 체중을 유지하고, 비만을 예방하는 것이 대장암 예방에 중요합니다.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>대장암은 초기 증상이 거의 없기 때문에 정기적인 검진이 매우 중요합니다. 50세 이후에는 대장 내시경 검사를 정기적으로 받는 것이 권장되며, 건강한 식습관과 꾸준한 운동이 예방에 큰 도움이 됩니다. 가족력이 있는 경우, 더 적극적으로 검진을 받는 것이 좋습니다.</p>
`;

// 전문가의 소견 영상
expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 대장암 예방</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/snmCVIFznms" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>영상 제공 :유튜브 EBSDocumentary (EBS 다큐) 채널 </p>
`;

    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [267.5, 179.6], // 남자와 여자의 대장암 발병률
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (대장암)
    const ageData = {
        labels: ['0-4세', '5-9세', '10-14세', '15-19세', '20-24세', '25-29세', '30-34세', '35-39세', '40-44세', '45-49세',
                 '50-54세', '55-59세', '60-64세', '65-69세', '70-74세', '75-79세', '80-84세', '85세 이상'],
        datasets: [{
            label: '여성 발병률 (%)',
            data: [0.0, 0.0, 0.3, 0.8, 4.0, 12.4, 32.7, 57.4, 97.3, 125.6, 
                   218.8, 301.8, 432.4, 581.3, 704.6, 839.6, 920.0, 813.1], // 여성 나이대별 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: '남성 발병률 (%)',
            data: [0.0, 0.0, 0.1, 1.0, 5.3, 13.8, 37.2, 64.6, 106.9, 135.4, 
                   248.6, 371.6, 575.0, 803.8, 961.5, 1127.9, 1246.6, 1200.4], // 남성 나이대별 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}
else if (disease === 'diabetes') {
    healthTipsContent.innerHTML = `
    <h3>당뇨병 의학 정보</h3>
    <p><strong>당뇨병</strong>은 인슐린의 부족 또는 인슐린 저항으로 인해 혈당 조절에 문제가 생기는 질환입니다. 초기에는 증상이 미미할 수 있지만, 혈당이 지속적으로 높으면 피로, 잦은 배뇨, 갈증, 체중 감소 등의 증상이 나타날 수 있습니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 초기에는 별다른 증상이 없으며, 일부는 극심한 갈증이나 잦은 배뇨를 경험할 수 있습니다.</li>
        <li><strong>2단계:</strong> 피로감, 체중 감소, 피부 상처 치유 지연 등의 증상이 나타날 수 있습니다.</li>
        <li><strong>3단계:</strong> 혈당 조절이 어려워지며, 시력 저하, 신경 손상(당뇨병성 신경병증) 등의 합병증이 발생할 수 있습니다.</li>
        <li><strong>4단계:</strong> 당뇨병이 진행되어 심각한 합병증이 발생할 수 있으며, 심혈관 질환, 신장 질환, 망막병증 등의 문제를 일으킬 수 있습니다.</li>
    </ul>

    <h3>당뇨병의 주요 발생 원인</h3>
    <ul>
        <li><strong>유전적 요인:</strong> 당뇨병 가족력이 있으면 발병 확률이 증가합니다.</li>
        <li><strong>비만:</strong> 과체중이나 비만은 당뇨병 발병의 주요 위험 요소입니다.</li>
        <li><strong>운동 부족:</strong> 운동 부족은 혈당 조절에 악영향을 미치며, 당뇨병 위험을 높입니다.</li>
        <li><strong>불규칙한 식습관:</strong> 고탄수화물, 고당분 음식의 과도한 섭취는 당뇨병을 유발할 수 있습니다.</li>
        <li><strong>나이:</strong> 나이가 많을수록 당뇨병 발병 위험이 높아집니다.</li>
    </ul>
`;

// 당뇨병 예방 수칙
preventionText.innerHTML = `
    <h3>당뇨병 예방 수칙</h3>
    <ul>
        <li><strong>건강한 체중 유지:</strong> 적정 체중을 유지하고 비만을 예방하는 것이 중요합니다.</li>
        <li><strong>규칙적인 운동:</strong> 일주일에 최소 150분의 중강도 운동을 하는 것이 당뇨병 예방에 도움이 됩니다.</li>
        <li><strong>건강한 식습관 유지:</strong> 과도한 당분과 고탄수화물 음식을 피하고, 채소, 통곡물, 저지방 단백질을 섭취하세요.</li>
        <li><strong>금연:</strong> 흡연은 당뇨병의 합병증 위험을 증가시키므로 금연이 중요합니다.</li>
        <li><strong>정기적인 혈당 체크:</strong> 혈당을 주기적으로 체크하여 조기에 문제를 발견하는 것이 중요합니다.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>당뇨병은 초기 증상이 없을 수 있어 조기 발견이 어렵습니다. 규칙적인 건강 검진을 통해 혈당 수치를 체크하고, 건강한 생활습관을 유지하는 것이 매우 중요합니다. 특히, 체중 관리와 운동은 당뇨병 예방에 큰 도움이 됩니다.</p>
`;

// 전문가의 소견 영상
expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 당뇨병 예방</h4>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/Gh81gech3d0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>영상 제공 :유튜브 EBS 컬렉션 - 사이언스 채널 </p>
`;

    // 성별 차트 데이터 (당뇨병)
    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [14.4, 10.7], // 남자와 여자의 당뇨병 발병률 (예시: 14.4%와 10.7%)
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (당뇨병)
    const ageData = {
        labels: ['19-29세', '30-39세', '40-49세', '50-59세', '60-69세', '70세 이상'],
        datasets: [{
            label: '남성 발병률 (%)',
            data: [2.8, 3.1, 8.9, 24.1, 25.1, 27.8], // 남성 나이대별 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: '여성 발병률 (%)',
            data: [0.2, 2.9, 3.3, 11.1, 16.3, 30.6], // 여성 나이대별 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}

else if (disease === 'depression') {
    healthTipsContent.innerHTML = `
    <h3>우울증 의학 정보</h3>
    <p><strong>우울증</strong>은 지속적인 슬픔, 기쁨 부족, 관심의 상실, 에너지 부족 등의 증상으로 나타나는 정신적 질환입니다. 우울증은 다양한 원인으로 발생할 수 있으며, 치료가 필요한 상태로 방치할 경우 일상 생활에 심각한 영향을 미칠 수 있습니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 가벼운 슬픔, 피로감, 불안감 등의 증상이 나타날 수 있습니다.</li>
        <li><strong>2단계:</strong> 지속적인 우울감, 수면 문제, 식욕 변화, 자신감 저하 등의 증상이 나타날 수 있습니다.</li>
        <li><strong>3단계:</strong> 자살 생각, 무기력감, 사회적 고립 등의 증상이 나타나며, 전문적인 치료가 필요할 수 있습니다.</li>
        <li><strong>4단계:</strong> 우울증이 심각해져 일상생활이 어려워지고, 정신 건강 관리가 필수적입니다.</li>
    </ul>

    <h3>우울증의 주요 발생 원인</h3>
    <ul>
        <li><strong>유전적 요인:</strong> 가족 중 우울증 환자가 있을 경우 발병 위험이 증가할 수 있습니다.</li>
        <li><strong>호르몬 불균형:</strong> 호르몬 변화, 특히 여성 호르몬의 변화는 우울증의 위험을 증가시킬 수 있습니다.</li>
        <li><strong>스트레스:</strong> 심각한 스트레스나 외부 환경의 변화는 우울증을 유발할 수 있습니다.</li>
        <li><strong>사회적 고립:</strong> 고립감이나 대인관계 문제는 우울증의 발병 위험을 높일 수 있습니다.</li>
    </ul>
`;

// 우울증 예방 수칙
preventionText.innerHTML = `
    <h3>우울증 예방 수칙</h3>
    <ul>
        <li><strong>정기적인 운동:</strong> 운동은 우울증 예방에 효과적이며, 기분을 개선하고 스트레스를 완화하는 데 도움이 됩니다.</li>
        <li><strong>건강한 식습관:</strong> 균형 잡힌 식사를 통해 신체 건강을 유지하고, 뇌에 필요한 영양소를 공급하세요.</li>
        <li><strong>사회적 활동:</strong> 친구나 가족과의 교류를 통해 사회적 고립을 피하고 정신적 안정을 유지하세요.</li>
        <li><strong>스트레스 관리:</strong> 스트레스를 관리하고, 이완 기법이나 명상 등을 통해 심리적 안정을 찾는 것이 중요합니다.</li>
        <li><strong>전문가 상담:</strong> 우울증 증상이 지속되거나 심각해지기 전에 전문가의 상담을 받는 것이 중요합니다.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>우울증은 시간이 지나면 자연히 해결되지 않습니다. 증상이 경미하더라도 조기에 치료를 시작하는 것이 중요하며, 전문가의 상담을 받는 것이 우울증 예방과 치료에 큰 도움이 됩니다. 정기적인 운동, 균형 잡힌 식사, 그리고 사회적 활동도 예방에 중요한 역할을 합니다.</p>
`;

// 전문가의 소견 영상
expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 우울증 예방</h4>
     <iframe width="560" height="315" src="https://www.youtube.com/embed/T3YEeWyxCLo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>영상 제공 :유튜브 세브란스 채널 </p>
`;

    // 성별 차트 데이터 (우울증)
    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [6.0, 12.0], // 남자와 여자의 우울증 발병률 (예시: 남자 6.0%, 여자 12.0%)
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (우울증)
    const ageData = {
        labels: ['19-29세', '30-39세', '40-49세', '50-59세', '60-69세', '70세 이상'],
        datasets: [{
            label: '남성 발병률 (%)',
            data: [2.5, 4.0, 8.0, 10.0, 12.0, 15.0], // 남성 나이대별 우울증 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: '여성 발병률 (%)',
            data: [5.0, 7.0, 10.0, 15.0, 18.0, 20.0], // 여성 나이대별 우울증 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}
else if (disease === 'dementia') {
    healthTipsContent.innerHTML = `
    <h3>치매 의학 정보</h3>
    <p><strong>치매</strong>는 기억력, 사고력, 문제 해결 능력, 일상적인 활동을 수행하는 능력 등에 영향을 미치는 증상군을 의미하는 질환입니다. 주로 노인에서 발병하지만, 그 외의 연령대에서도 발생할 수 있습니다. 치매는 시간이 지남에 따라 점진적으로 증상이 악화됩니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 가벼운 기억력 저하, 가끔씩 일상적인 일을 잊어버리는 증상이 있을 수 있습니다.</li>
        <li><strong>2단계:</strong> 단기 기억력의 문제가 심화되며, 길이나 일정 등을 기억하는 데 어려움을 겪을 수 있습니다.</li>
        <li><strong>3단계:</strong> 물건을 자주 잃어버리거나, 혼자서 일상적인 활동을 수행하기 어려워지며, 사람들의 이름을 기억하는 데 어려움이 있을 수 있습니다.</li>
        <li><strong>4단계:</strong> 치매가 진행되면, 인지 기능이 크게 저하되어 일상 생활을 독립적으로 수행하는 것이 불가능해지고, 가족이나 돌봄이 필요합니다.</li>
    </ul>

    <h3>치매의 주요 발생 원인</h3>
    <ul>
        <li><strong>노화:</strong> 나이가 많을수록 치매 발생 위험이 증가합니다.</li>
        <li><strong>유전적 요인:</strong> 가족력이 있을 경우 치매 발생 위험이 높아질 수 있습니다.</li>
        <li><strong>혈관 질환:</strong> 고혈압, 당뇨병, 고지혈증 등 혈관에 관련된 질환이 치매를 유발할 수 있습니다.</li>
        <li><strong>알츠하이머병:</strong> 가장 흔한 형태의 치매로, 뇌의 세포가 점진적으로 손상되어 기억력과 사고 능력이 저하됩니다.</li>
    </ul>
`;

// 치매 예방 수칙
preventionText.innerHTML = `
    <h3>치매 예방 수칙</h3>
    <ul>
        <li><strong>정기적인 운동:</strong> 규칙적인 운동은 뇌의 건강을 유지하고, 혈액순환을 촉진시켜 치매 예방에 도움이 됩니다.</li>
        <li><strong>건강한 식습관:</strong> 뇌 건강에 좋은 음식(예: 생선, 견과류, 과일, 채소)을 섭취하고, 나쁜 지방과 당분을 줄이는 것이 중요합니다.</li>
        <li><strong>정신적 활동 유지:</strong> 새로운 것을 배우거나, 퍼즐, 독서 등 정신적 활동을 통해 뇌를 자극하는 것이 좋습니다.</li>
        <li><strong>사회적 활동:</strong> 사회적 상호작용을 유지하고, 친구나 가족과의 대화를 통해 인지 기능을 유지하세요.</li>
        <li><strong>정기적인 건강 관리:</strong> 고혈압, 당뇨병, 고지혈증 등 만성 질환을 관리하여 뇌의 건강을 지키는 것이 중요합니다.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>치매는 초기 증상이 가벼워 자주 간과될 수 있지만, 증상이 심화되면 돌이킬 수 없을 만큼 뇌가 손상될 수 있습니다. 조기 발견과 예방이 중요하며, 건강한 생활습관과 정기적인 검진이 치매 예방에 큰 도움이 됩니다.</p>
`;

// 전문가의 소견 영상
expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 치매 예방</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/bCULyQp6LYI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>영상 제공 :유튜브 서울아산병원 채널 </p>
`;

    // 성별 차트 데이터 (치매)
    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [7.0, 12.5], // 남자와 여자의 치매 발병률 (예시: 남자 7.0%, 여자 12.5%)
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (치매)
    const ageData = {
        labels: ['60-69세', '70-79세', '80-89세', '90세 이상'],
        datasets: [{
            label: '남성 발병률 (%)',
            data: [5.5, 10.0, 20.0, 25.0], // 남성 나이대별 치매 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: '여성 발병률 (%)',
            data: [7.0, 12.5, 22.0, 28.0], // 여성 나이대별 치매 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}
else if (disease === 'stroke') {
    healthTipsContent.innerHTML = `
    <h3>뇌졸중 의학 정보</h3>
    <p><strong>뇌졸중</strong>은 뇌로 가는 혈액의 흐름이 차단되거나 출혈이 발생하여 뇌세포가 손상되는 상태를 말합니다. 뇌졸중은 매우 급작스럽게 발생하며, 증상이 나타날 경우 즉각적인 치료가 필요합니다. 주요 증상으로는 한쪽 팔이나 다리의 마비, 언어 장애, 시각 장애, 갑작스러운 두통 등이 있을 수 있습니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 갑작스러운 팔, 다리 마비나 무감각, 언어 장애(말이 어눌하거나 알아듣기 어려운 경우)가 나타날 수 있습니다.</li>
        <li><strong>2단계:</strong> 증상이 심화되면, 혼란스러움, 급격한 두통, 시각 장애, 기억력 저하 등이 발생할 수 있습니다.</li>
        <li><strong>3단계:</strong> 신체 일부에 마비가 지속되고, 혼자서 일상적인 활동을 수행하기 어려워집니다. 증상이 심각해지면 의식 장애가 나타날 수 있습니다.</li>
        <li><strong>4단계:</strong> 뇌졸중이 심각해지면, 신체 기능이 완전히 상실되거나, 일상생활을 독립적으로 수행하기 어려워집니다. 긴급한 의료 처치가 필요합니다.</li>
    </ul>

    <h3>뇌졸중의 주요 발생 원인</h3>
    <ul>
        <li><strong>고혈압:</strong> 고혈압은 뇌졸중의 가장 큰 위험 요인입니다. 고혈압을 제대로 관리하지 않으면 뇌혈관에 부담을 주어 뇌졸중을 유발할 수 있습니다.</li>
        <li><strong>당뇨병:</strong> 당뇨병이 있는 경우, 혈관이 손상되어 뇌졸중 위험이 증가합니다.</li>
        <li><strong>흡연:</strong> 흡연은 혈관을 좁히고 혈압을 높여 뇌졸중의 발생 확률을 높입니다.</li>
        <li><strong>고지혈증:</strong> 높은 콜레스테롤 수치나 고지혈증은 동맥 경화를 촉진시켜 뇌졸중 위험을 증가시킬 수 있습니다.</li>
        <li><strong>유전적 요인:</strong> 가족 중 뇌졸중 환자가 있을 경우, 발병 확률이 높아질 수 있습니다.</li>
    </ul>
`;

// 뇌졸중 예방 수칙
preventionText.innerHTML = `
    <h3>뇌졸중 예방 수칙</h3>
    <ul>
        <li><strong>건강한 식습관:</strong> 저염, 저지방 음식을 섭취하고, 과일과 채소를 충분히 섭취하는 것이 중요합니다.</li>
        <li><strong>규칙적인 운동:</strong> 매일 30분 정도의 유산소 운동을 통해 혈액순환을 촉진하고, 심혈관 건강을 유지하세요.</li>
        <li><strong>금연:</strong> 흡연은 뇌졸중 위험을 크게 증가시킵니다. 금연을 통해 예방할 수 있습니다.</li>
        <li><strong>체중 관리:</strong> 과체중은 뇌졸중 위험을 높이므로 적정 체중을 유지하는 것이 중요합니다.</li>
        <li><strong>정기적인 건강 검진:</strong> 고혈압, 당뇨병, 고지혈증 등 만성 질환을 관리하고, 정기적인 혈압 체크와 혈액 검사를 통해 예방할 수 있습니다.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>뇌졸중은 시간이 중요한 질환입니다. 증상이 나타났을 때 빠르게 병원에 가야 하며, 치료가 지체되면 심각한 후유증을 남길 수 있습니다. 고혈압과 당뇨병 등의 만성 질환을 꾸준히 관리하고, 금연, 건강한 식습관과 운동을 통해 예방할 수 있습니다.</p>
`;

// 전문가의 소견 영상
expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 뇌졸중 예방</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/3SQarCxfRlc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>영상 제공 :유튜브 굿닥터인부산 채널 </p>
`;

    
    // 성별 차트 데이터 (뇌졸중)
    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [5.2, 4.1], // 남자와 여자의 뇌졸중 발병률 (예시: 남자 5.2%, 여자 4.1%)
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (뇌졸중)
    const ageData = {
        labels: ['30-39세', '40-49세', '50-59세', '60-69세', '70-79세', '80세 이상'],
        datasets: [{
            label: '남성 발병률 (%)',
            data: [0.5, 2.0, 4.5, 9.0, 18.5, 27.0], // 남성 나이대별 뇌졸중 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: '여성 발병률 (%)',
            data: [0.4, 1.5, 3.8, 7.5, 16.0, 25.0], // 여성 나이대별 뇌졸중 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });
}
else if (disease === 'hypertension') {
    healthTipsContent.innerHTML = `
    <h3>고혈압 의학 정보</h3>
    <p><strong>고혈압</strong>은 혈압이 지속적으로 높은 상태를 말합니다. 고혈압은 심장과 혈관에 부담을 주며, 장기적으로 심장 질환, 뇌졸중, 신장 질환 등 여러 합병증을 유발할 수 있습니다. 고혈압은 초기에는 증상이 없을 수 있어 '침묵의 살인자'라고도 불립니다. 정기적인 혈압 측정을 통해 조기에 발견하고 관리하는 것이 중요합니다.</p>

    <h3>단계별 증상</h3>
    <ul>
        <li><strong>1단계:</strong> 고혈압의 초기 증상은 뚜렷하지 않지만, 가끔씩 두통이나 어지러움을 느낄 수 있습니다.</li>
        <li><strong>2단계:</strong> 증상이 심해지면, 가슴 통증, 호흡 곤란, 불규칙한 심박수 등이 나타날 수 있습니다.</li>
        <li><strong>3단계:</strong> 고혈압이 지속되면, 심장, 신장, 뇌 등 주요 장기들이 손상될 수 있으며, 합병증이 발생할 수 있습니다.</li>
        <li><strong>4단계:</strong> 고혈압으로 인한 합병증이 심각해지면, 심장마비, 뇌졸중, 신부전 등의 질환을 초래할 수 있습니다.</li>
    </ul>

    <h3>고혈압의 주요 발생 원인</h3>
    <ul>
        <li><strong>유전적 요인:</strong> 고혈압은 가족력이 있을 경우 발병 위험이 증가합니다.</li>
        <li><strong>불규칙한 식습관:</strong> 짠 음식을 자주 먹거나, 과도한 알콜 섭취, 고지방 식사는 고혈압의 주요 원인입니다.</li>
        <li><strong>운동 부족:</strong> 규칙적인 운동 부족은 혈압을 높일 수 있습니다.</li>
        <li><strong>비만:</strong> 과체중이나 비만은 고혈압의 위험을 높입니다.</li>
        <li><strong>스트레스:</strong> 지속적인 스트레스는 혈압을 높일 수 있습니다.</li>
    </ul>
`;

// 고혈압 예방 수칙
preventionText.innerHTML = `
    <h3>고혈압 예방 수칙</h3>
    <ul>
        <li><strong>건강한 식습관:</strong> 저염, 저지방 음식을 섭취하고, 과일, 채소, 통곡물 등을 많이 먹는 것이 중요합니다.</li>
        <li><strong>규칙적인 운동:</strong> 매일 30분 이상의 유산소 운동을 통해 혈압을 낮추는 데 도움이 됩니다.</li>
        <li><strong>금연:</strong> 흡연은 혈압을 높이고, 혈관을 손상시킬 수 있으므로 금연이 필요합니다.</li>
        <li><strong>스트레스 관리:</strong> 스트레스는 혈압을 상승시키므로, 이완 기법이나 명상 등을 통해 스트레스를 관리하는 것이 중요합니다.</li>
        <li><strong>정기적인 혈압 체크:</strong> 고혈압은 자각 증상이 없을 수 있으므로, 정기적으로 혈압을 측정하여 조기에 발견하고 관리하는 것이 중요합니다.</li>
    </ul>

    <h3>전문가의 소견</h3>
    <p>고혈압은 시간이 지나면 심각한 합병증을 유발할 수 있기 때문에, 조기에 발견하고 꾸준히 관리하는 것이 중요합니다. 건강한 생활 습관, 규칙적인 운동,
     <br>균형 잡힌 식단을 통해 혈압을 관리하고, 정기적으로 혈압을 체크하여 건강을 지킬 수 있습니다.</p>
`;

// 전문가의 소견 영상
expertVideo.innerHTML = `
    <h4>전문가 인터뷰: 고혈압 관리</h4>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/QQ7jxYp5z0o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>영상 제공 :유튜브 서울아산병원 채널 </p>
`;

    // 성별 차트 데이터 (고혈압)
    const genderData = {
        labels: ['남자', '여자'],
        datasets: [{
            label: '발병률 (%)',
            data: [30.5, 28.7], // 남자와 여자의 고혈압 발병률 (예시: 남자 30.5%, 여자 28.7%)
            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const ctxGender = document.getElementById('disease-gender-chart-canvas').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',  // 원형 차트
        data: genderData,
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
                        }
                    }
                }
            }
        }
    });

    // 나이대별 발병률 차트 데이터 (고혈압)
    const ageData = {
        labels: ['19-29세', '30-39세', '40-49세', '50-59세', '60-69세', '70세 이상'],
        datasets: [{
            label: '남성 발병률 (%)',
            data: [5.5, 10.0, 20.3, 33.8, 45.1, 53.7], // 남성 나이대별 고혈압 발병률
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: '여성 발병률 (%)',
            data: [3.2, 9.5, 18.7, 32.4, 42.3, 50.9], // 여성 나이대별 고혈압 발병률
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const ctxAge = document.getElementById('disease-age-chart-canvas').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',  // 막대 차트
        data: ageData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(2) + '%';  // 퍼센트 표시
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';  // 발병률 표시
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
