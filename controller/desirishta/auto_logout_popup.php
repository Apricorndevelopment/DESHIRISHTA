<!-- HTML for the Inactivity Modal -->
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
        
        <button onclick="resetSession()" class="active-btn">I am Active</button>
    </div>
</div>

<!-- CSS Styling -->
<style>
    .timeout-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Darker backdrop */
        backdrop-filter: blur(5px);
        z-index: 999999; /* Very high z-index to stay on top */
        display: flex;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.4s ease;
    }

    .timeout-modal-content {
        background: #fff;
        width: 90%;
        max-width: 400px;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        animation: slideUp 0.4s ease;
        border-top: 5px solid hotpink; /* Matches your theme */
    }

    .timeout-icon {
        font-size: 50px;
        color: hotpink;
        margin-bottom: 15px;
    }

    .timeout-modal-content h3 {
        margin: 0 0 10px 0;
        color: #333;
        font-size: 24px;
        font-weight: 600;
    }

    .timeout-modal-content p {
        color: #666;
        margin: 5px 0;
        font-size: 16px;
    }

    .timer-display {
        font-size: 35px;
        font-weight: bold;
        color: #d9534f; /* Red color for urgency */
        margin: 15px 0;
        font-family: monospace;
        background: #f9f9f9;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #eee;
    }

    .active-btn {
        background: hotpink;
        color: #fff;
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 105, 180, 0.4);
        margin-top: 10px;
    }

    .active-btn:hover {
        background: #d11a7a;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 105, 180, 0.6);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<!-- JavaScript Logic -->
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
        // Clear existing timer
        clearTimeout(inactivityTimer);
        
        // Start new timer triggers 'showPopup' after 5 minutes
        inactivityTimer = setTimeout(showPopup, INACTIVITY_TIME_LIMIT);
    }

    // Function to reset timer on user activity
    function resetTimer() {
        // Only reset if the popup is NOT currently shown
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
        
        // Start the countdown interval (runs every 1 second)
        countdownTimer = setInterval(function() {
            timeLeft--;
            updateTimerDisplay();

            // If time runs out, logout
            if (timeLeft <= 0) {
                clearInterval(countdownTimer);
                window.location.href = 'logout.php'; // Redirect to logout
            }
        }, 1000);
    }

    // Function to update the HTML text (MM:SS format)
    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        // Add leading zeros
        const formattedTime = 
            (minutes < 10 ? "0" + minutes : minutes) + ":" + 
            (seconds < 10 ? "0" + seconds : seconds);
            
        document.getElementById('timerDisplay').innerText = formattedTime;
    }

    // Function called when "I am Active" button is clicked
    function resetSession() {
        // Hide popup
        document.getElementById('timeoutModal').style.display = 'none';
        
        // Stop the countdown
        clearInterval(countdownTimer);
        
        // Reset state
        isPopupVisible = false;
        
        // Restart the inactivity monitor
        startInactivityTimer();
    }

    // Attach event listeners to document
    events.forEach(function(event) {
        document.addEventListener(event, resetTimer, true);
    });

    // Initialize on load
    startInactivityTimer();
</script>