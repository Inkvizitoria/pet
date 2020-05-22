<div class="content-page">
    <div class="sign-form">
        <div class="form-heading">{$title}</div>

        <div class="form-signup">
            <form action="/signup/save" method="post">
                {if isset($error)}
                <div class="form-label error">
                    {foreach from=$error item=err}
                    {$err}
                    {/foreach}
                </div>
                {/if}
                <div class="form-group">
                    <div class="form-label">First Name </div>
                    <div class="form-input">
                        <input type="text" name="fname" id="firstname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Last Name </div>
                    <div class="form-input">
                        <input type="text" name="lname" id="firstname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Email </div>
                    <div class="form-input">
                        <input type="text" name="email" id="firstname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Password </div>
                    <div class="form-input">
                        <input type="Password" name="password" id="firstname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Gender </div>
                    <div class="form-radio">
                        <input type="radio" name="gender" value="1" checked> Male
                        <input type="radio" name="gender" value="0"> Female
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Country </div>
                    <div class="form-input">
                        <label>
                            <select name="country">
                                <option selected="" disabled value="">Select Country</option>
                                {foreach from=$country item=item}
                                <option value="{$item['id']}">{$item['name']}</option>
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
                    <button type="submit">Registration</button>
                </div>
            </form>

        </div>
    </div>

</div>