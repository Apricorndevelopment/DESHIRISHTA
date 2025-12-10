
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script>
        $(document).ready(function() {
            function disableBack() {
                window.history.forward()
            }
            window.onload = disableBack();
            window.onpageshow = function(e) {
                if (e.persisted)
                    disableBack();
            }
            window.location.href="index.php";
        });
    </script>

