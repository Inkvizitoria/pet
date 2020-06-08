<div class="content-page">
    <div class="sign-form">
        <div class="form-heading">{$title}</div>

        <div class="form-signup">
            <div>
                <div class="form-label error" id="errors">

                </div>
                <div class="form-group">
                    <div class="form-label">First Name </div>
                    <div class="form-input">
                        <input type="text" name="fname" id="firstname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Last Name </div>
                    <div class="form-input">
                        <input type="text" name="lname" id="lastname">
                    </div>
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

                <div class="form-group">
                    <div class="form-label">Gender </div>
                    <div class="form-radio">
                        <input type="radio" name="gender" value="1" checked id="male"> Male
                        <input type="radio" name="gender" value="0" id="female"> Female
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Country </div>
                    <div class="form-input">
                        <label>
                            <select name="country" id="country_select">
                                <option selected="" disabled value="">Select Country</option>
                                {foreach from=$country item=item}
                                <option value="{$item['id']}" id="country">{$item['name']}</option>
                                {/foreach}
                            </select>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Photo </div>
                    <div class="form-input">
                        <input type="file" name="file" style="color: #FFF">
                    </div>
                </div>

                <div class="bottom-footer">
                    <button type="reset">Reset</button>
                    <button id="reg" type="submit">Registration</button>
                </div>
            </div>

        </div>
    </div>

</div>
<script>
    document.getElementById("reg").addEventListener("click",  function(){
        let country_select = document.getElementById("country_select");
        let country_id = country_select.options[country_select.selectedIndex].value;
        let data = {
            'fname': document.getElementById("firstname").value,
            'lname': document.getElementById("lastname").value,
            'email': document.getElementById("email").value,
            'password': document.getElementById("password").value,
            'gender': document.getElementById("male").checked ? document.getElementById("male").value : document.getElementById("female").value,
            'country': country_id
        }
        fetch("/signup/save", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if(data.error) {
                    console.log(data.error)
                    let error = document.getElementById("errors");
                    error.innerHTML = '';
                    for (let key in data.error) {
                        error.innerHTML += data.error[key]
                    }
                    error.style.display = "block";
                } else {
                    window.location.href = data.url;
                }

            })
    });


</script>