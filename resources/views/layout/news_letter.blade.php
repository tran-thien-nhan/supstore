<style>
    .global-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: white;
        color: black;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
        margin-right: 10px;
    }
</style>
<br>
<section class="section is-width-wide has-no-side-gutter">
    <div class="newsletter_section newsletter-both-names--false newsletter-bgr-true text-center blur-up lazyloaded"
        data-bg="//axeandsledge.com/cdn/shop/files/Banner_d29f134e-2d84-422d-8016-21406da74ef1_1600x.jpg?v=1613692537"
        data-sizes="100vw"
        style="background-image: url(&quot;https://t4.ftcdn.net/jpg/03/50/81/89/360_F_350818949_lJTfzSTDr79e9Kn55PUVZjN19ct20uGc.jpg&quot;); opacity: 0.8">
        <div class="container d-flex align-items-center" style="height: 400px;">
            <div class="offset-md-3 col-md-6 col-12 section_form">
                <h2 class="title text-white display-4 fw-bold">Sign up for our newsletter</h2>
                <div class="newsletter-text text-white">
                    <p class="fs-4">Sign up to get the latest on sales, new releases and more!</p>
                </div>
                <div class="newsletter">
                    <span class="message"></span>
                    <form method="post" action="{{ route('subscribe') }}" id="contact_form" accept-charset="UTF-8"
                        class="contact-form">
                        @csrf
                        <input type="hidden" name="form_type" value="customer">
                        <input type="hidden" name="utf8" value="✓">
                        <input type="hidden" name="contact[tags]" value="prospect,newsletter">
                        <div class="input-row"></div>
                        <div class="input-row">
                            <input type="hidden" name="challenge" value="false">
                            <div class="d-flex">
                                <input type="email" class="contact_email form-control form-control-sm" name="email"
                                    required="" placeholder="Enter your email address..."
                                    aria-label="enter your email address..." data-uw-rm-form="fx">
                                <input type="submit"
                                    class="global-button global-button--primary newsletter-form__sign-up btn btn-secondary btn-sm ms-2"
                                    value="Sign Up" data-uw-rm-form="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
