<?php

    namespace App\Http\Controllers\Admin;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Model\Admin\User;
    use Gregwar\Captcha\CaptchaBuilder;
    use Gregwar\Captcha\PhraseBuilder;
    use Illuminate\Support\Facades\Cookie;

    class CaptchaController extends Controller
    {



        public function captcha_create(){


            $phrase = new PhraseBuilder;

            $code = $phrase->build(4);

            $builder = new CaptchaBuilder($code,$phrase);

            $builder->setBackgroundColor(220,210,230);

            $builder->setMaxAngle(25);

            $builder->setMaxBehindLines(0);

            $builder->setMaxFrontLines(0);

            $builder->build($width = 100,$height = 40,$font = null);

            $phrase = $builder->getPhrase();

            \Session::flash('code',$phrase);

            header("Cache-Control:no-cache, must-revalidate");
            ob_end_clean();
            header('Content-type: image/jpeg');  
            $builder->output();

        }



        public function captcha_check(Request $request){


                        
    
           echo $request->cookie('user');




        }










    }







?>