<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madvanilla Pop-up</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans KR', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #fafafa;
            color: #333;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            padding: 40px;
            background: white;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin: 20px;
            position: relative;
            overflow: hidden;
        }

        .text-section {
            max-width: 45%;
            padding-right: 40px;
        }

        .text-section h1 {
            color: #d44b2a;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .text-section p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666;
            margin-bottom: 2rem;
        }

        .text-section strong {
            color: #333;
            font-weight: 500;
        }

        .date {
            background: linear-gradient(135deg, #d44b2a, #ff6b4a);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 75, 42, 0.2);
        }

        .date:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 75, 42, 0.3);
        }

        .image-section {
            flex: 1;
            padding-left: 40px;
        }

        .image-section img {
            max-width: 100%;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .image-section img:hover {
            transform: scale(1.02);
        }

        .logo {
            position: absolute;
            top: 40px;
            right: 40px;
            background: linear-gradient(135deg, #d44b2a, #ff6b4a);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(212, 75, 42, 0.2);
        }

        #datePopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border: none;
            padding: 30px;
            z-index: 1000;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 300px;
        }

        #datePopup label {
            display: block;
            margin-bottom: 10px;
            color: #666;
            font-size: 0.9rem;
        }

        #datePopup input {
            width: 100%;
            padding: 12px;
            border: 1px solid #eee;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        #datePopup button {
            background: #d44b2a;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        #datePopup button:hover {
            background: #ff6b4a;
        }

        #closePopup {
            background: #f5f5f5 !important;
            color: #666 !important;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 999;
            backdrop-filter: blur(5px);
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                padding: 20px;
            }

            .text-section {
                max-width: 100%;
                padding-right: 0;
                text-align: center;
                margin-bottom: 30px;
            }

            .image-section {
                padding-left: 0;
            }

            .logo {
                position: static;
                margin-top: 20px;
                text-align: center;
            }
        }
    </style>
    <script>
        $(document).ready(function(){
            $('.date').click(function(){
                $('#overlay, #datePopup').fadeIn(300);
                flatpickr("#newDateInput", {
                    dateFormat: "Y년 m월 d일",
                    defaultDate: new Date(),
                    onClose: function(selectedDates, dateStr) {
                        $('#newDateInput').val(dateStr);
                    }
                });
            });

            $('#closePopup, #overlay').click(function(){
                $('#overlay, #datePopup').fadeOut(300);
            });

            $('#datePopup').click(function(e){
                e.stopPropagation();
            });

            $('#saveDate').click(function(){
                let newDate = $('#newDateInput').val();
                if (newDate) {
                    $('#dateDisplay').text(newDate);
                    $('#overlay, #datePopup').fadeOut(300);
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="text-section">
            <h1>our pop-up</h1>
            <p><strong>매드바닐라</strong>가 매바들을 만났던 소중한 추억을 담았습니다.</p>
            <span class="date" id="dateDisplay">2024년 11월</span>
        </div>
        <div class="image-section">
            <img src="example-image.png" alt="Madvanilla Pop-up">
        </div>
        <div class="logo">
            madvanilla in cafeshow
        </div>
    </div>
    <div id="overlay"></div>
    <div id="datePopup">
        <label for="newDateInput">날짜 선택:</label>
        <input type="text" id="newDateInput">
        <button id="saveDate">저장</button>
        <button id="closePopup">닫기</button>
    </div>
</body>
</html>