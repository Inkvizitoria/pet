<div class="content-page">
    <div class="sign-form sign-in">
        <div class="form-heading">{$title}</div>

        <div class="form-signup">
            <form action="/signin/login" method="post">
                {if isset($error)}
                <div class="form-label error">
                    {foreach from=$error item=err}
                    {$err}
                    {/foreach}
                </div>
                {/if}

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

                <div class="bottom-footer">
                    <button type="submit">Login</button>
                </div>
            </form>

        </div>
    </div>

</div>