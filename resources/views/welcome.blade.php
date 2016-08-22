@extends('layouts.master')

@section('title_section')
    <title>Metronic - Laravel Test</title>
@endsection

@section('styles_section')
    {!! HTML::style('css/coming-soon.css') !!}
@endsection

@section('content_section')
    <div class="container" style="background-color: #98a6ba">
        <div class="row">
            <div class="col-md-6 coming-soon-content">
                <h1>&iexcl;Viene pronto!</h1>
                <p>
                    La portada de CUBiM se encuentra aun en construcci&oacute;n.
                </p>
                <br>
                <form class="form-inline" action="#">
                    <div class="input-group input-large">
                        <input type="text" class="form-control">
					<span class="input-group-btn">
					<button class="btn blue" type="button">
					<span>
					Subscribir </span>
                        <i class="m-icon-swapright m-icon-white"></i></button>
					</span>
                    </div>
                </form>
                <ul class="social-icons margin-top-20">
                    <li>
                        <a href="javascript:;" data-original-title="Feed" class="rss">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-original-title="Facebook" class="facebook">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-original-title="Twitter" class="twitter">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-original-title="Goole Plus" class="googleplus">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-original-title="Pinterest" class="pintrest">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-original-title="Linkedin" class="linkedin">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-original-title="Vimeo" class="vimeo">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 coming-soon-countdown">
                <div id="defaultCountdown">
                </div>
            </div>
        </div>
        <!--/end row-->
    </div>
@endsection

@section('scripts_section')
    {!! HTML::script('scripts/coming-soon.js') !!}
    {!! HTML::script('plugins/countdown/jquery.countdown.min.js') !!}
    {!! HTML::script('plugins/backstretch/jquery.backstretch.min.js') !!}

    <script>
        jQuery(document).ready(function () {
            ComingSoon.init();
            // init background slide images
            $.backstretch([
                "../../assets/admin/pages/media/bg/1.jpg",
                "../../assets/admin/pages/media/bg/2.jpg",
                "../../assets/admin/pages/media/bg/3.jpg",
                "../../assets/admin/pages/media/bg/4.jpg"
            ], {
                fade: 1000,
                duration: 10000
            });
        });
    </script>
@endsection