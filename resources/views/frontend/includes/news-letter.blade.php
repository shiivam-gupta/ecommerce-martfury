<div class="ps-newsletter">
    <div class="ps-container">
        <p align="center" class="showMessage" style="color: red;"></p>
        <form class="ps-form--newsletter" action="" method="post">
            @csrf
            <div class="row">
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-form__left">
                        <h3>{{$appsetting->newsletter_title}}</h3>
                        <p>{!!$appsetting->newsletter_description!!}</p>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-form__right">
                        <div class="form-group--nest">
                            <input class="form-control news_email" name="news_email" type="email" placeholder="Email address">
                            <button type="button" class="ps-btn submitNews">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>