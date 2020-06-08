<div class="content-page">
    <div class="sign-form sign-in">
        <div class="form-heading">{$title}</div>

        <div class="form-signup">
            <div>
                <div class="form-label error" id="errors">
                </div>
                <div class="form-group">
                    <div class="form-label">Email </div>
                    <div class="form-input">
                        <input type="text" name="email" id="email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Password </div>
                    <div class="form-input">
                        <input type="Password" name="password" id="password">
                    </div>
                </div>

                <div class="bottom-footer">
                    <button id="logged"  type="submit">Sign In</button>
                </div>
            </div>

        </div>
    </div>

</div>
<script>

    document.getElementById("logged").addEventListener("click",  function(){
        let data = {
            'email': document.getElementById("email").value,
            'password': document.getElementById("password").value
        }
        fetch("/signin/signin", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if(data.error) {
                    let error = document.getElementById("errors");
                    error.innerText = data.error;
                    error.style.display = "block";
                } else {
                    window.location.href = data.url;
                }
            })
    });


</script>