<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="timeoutModal" class="timeout-modal" style="display: none;">
    <div class="timeout-modal-content">
        <div class="timeout-icon">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
        </div>
        
        <h3>Session Timeout Warning</h3>
        <p>You have been inactive for a while.</p>
        <p>You will be logged out in:</p>
        
        <div class="timer-display" id="timerDisplay">05:00</div>
        
        <p class="small-text">Click below to continue your session.</p>
        
        <button onclick="resetSession()" class="active-btn">
            <i class="fa fa-check-circle"></i> I am Active
        </button>
    </div>
</div>

<style>
    /* Import a bold decorative font */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;800&display=swap');

    .timeout-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(40, 30, 20, 0.85); /* Dark brown backdrop */
        backdrop-filter: blur(4px);
        z-index: 999999;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.4s ease;
        font-family: 'Montserrat', sans-serif; /* Bold font family */
    }

    .timeout-modal-content {
        /* Light Brown Background */
        background: #F3E5DC; 
        /* Dark Text Color */
        color: #4E342E; 
        width: 90%;
        max-width: 420px;
        padding: 40px 30px;
        border-radius: 20px;
        text-align: center;
        /* No border, using shadow for depth */
        box-shadow: 0 20px 50px rgba(0,0,0,0.4), 
                    0 -10px 0 0 #ff1493; /* "Single Decorative" Top Pink Strip using Shadow */
        animation: slideUp 0.4s ease;
    }

    .timeout-icon {
        font-size: 60px;
        color: #ff6441; /* Dark Icon */
        margin-bottom: 20px;
    }

    .timeout-modal-content h3 {
        margin: 0 0 15px 0;
        color: #9e6254; /* Even Darker Brown for Header */
        font-size: 26px;
        font-weight: 800; /* Extra Bold */
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: 'cinzel decorative';
    }

    .timeout-modal-content p {
        color: #5D4037;
        margin: 8px 0;
        font-size: 16px;
        font-weight: 600; /* Bold Text */
    }

    .timer-display {
        font-size: 42px;
        font-weight: 800; /* Extra Bold Numbers */
        color: #2D1B18; 
        margin: 25px 0;
        font-family: 'cinzel decorative',cursive;
        background: #E6D0C0; /* Slightly darker shade of light brown */
        padding: 15px;
        border-radius: 12px;
        /* No Border */
        box-shadow: inset 0 2px 5px rgba(0,0,0,0.1); 
    }

    .small-text {
        font-size: 14px !important;
        opacity: 0.8;
    }

    .active-btn {
        /* Dark Brown Button */
        background: #4E342E; 
        color: #F3E5DC;
        border: none; /* No Border */
        padding: 15px 40px;
        font-size: 16px;
        font-weight: 700; /* Bold */
        text-transform: uppercase;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(78, 52, 46, 0.4);
        margin-top: 15px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    /* Hover State: Pink */
    .active-btn:hover {
        background: #ff1493; /* Deep Pink */
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 20, 147, 0.5);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<script>
    // Configuration
    const INACTIVITY_TIME_LIMIT = 5 * 60 * 1000;
    const COUNTDOWN_DURATION = 5 * 60; 
    
    let inactivityTimer;
    let countdownTimer;
    let timeLeft = COUNTDOWN_DURATION;
    let isPopupVisible = false;

    // Events to detect user activity
    const events = ['mousemove', 'keypress', 'click', 'scroll', 'touchstart'];

    // Function to start monitoring inactivity
    function startInactivityTimer() {
        clearTimeout(inactivityTimer);
        inactivityTimer = setTimeout(showPopup, INACTIVITY_TIME_LIMIT);
    }

    // Function to reset timer on user activity
    function resetTimer() {
        if (!isPopupVisible) {
            startInactivityTimer();
        }
    }

    // Function to show the popup and start countdown
    function showPopup() {
        isPopupVisible = true;
        document.getElementById('timeoutModal').style.display = 'flex';
        timeLeft = COUNTDOWN_DURATION;
        updateTimerDisplay();
        
        countdownTimer = setInterval(function() {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                clearInterval(countdownTimer);
                // CHANGE THIS LINK TO YOUR ACTUAL LOGOUT SCRIPT
                window.location.href = 'logout.php'; 
            }
        }, 1000);
    }

    // Function to update the HTML text (MM:SS format)
    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        const formattedTime = 
            (minutes < 10 ? "0" + minutes : minutes) + ":" + 
            (seconds < 10 ? "0" + seconds : seconds);
            
        document.getElementById('timerDisplay').innerText = formattedTime;
    }

    // Function called when "I am Active" button is clicked
    function resetSession() {
        document.getElementById('timeoutModal').style.display = 'none';
        clearInterval(countdownTimer);
        isPopupVisible = false;
        startInactivityTimer();
    }

    events.forEach(function(event) {
        document.addEventListener(event, resetTimer, true);
    });

    startInactivityTimer();
</script>