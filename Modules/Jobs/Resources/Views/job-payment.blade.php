@extends('app::layouts.site')

@section('content')
   <div class="content-wrap">

      <div class="container clearfix">

         <div id="processTabs">
            <ul class="process-steps bottommargin clearfix">
               <li>
                  <a href="javascript:void(0);" class="i-circled i-bordered i-alt divcenter">1</a>
                  <h5>About the job</h5>
               </li>
               <li>
                  <a href="javascript:void(0);" class="i-circled i-bordered i-alt divcenter">2</a>
                  <h5>Working details</h5>
               </li>
               <li :class="{active : step == 3}">
                  <a href="javascript:void(0);" class="i-circled i-bordered i-alt divcenter">3</a>
                  <h5>Payment</h5>
               </li>
               <li :class="{active : step == 4}">
                  <a href="javascript:void(0);" class="i-circled i-bordered i-alt divcenter">4</a>
                  <h5>Finish</h5>
               </li>
            </ul>

            <div class="px-5 mt-5 col-md-8 mx-auto">
               <div v-if="step == 1">
                  <gm-job-payment @submitted="goto4($event)"> </gm-job-payment>
               </div>
               <div v-if="step == 2">

               </div>
               <div v-if="step == 3">

               </div>
               <div v-if="step == 4">

               </div>
            </div>
         </div>

      </div>

   </div>

@endsection

@section('feature')
   <!-- Page Title
		============================================= -->
   <section id="page-title" class="page-title-parallax page-title-dark page-title-center"
            style="background: url('/assets/img/security_2.jpg') no-repeat center center / cover; padding: 140px 0;" data-stellar-background-ratio="0.85">

      <div class="container clearfix">
         <h1>Post New Job</h1>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">New Job Listing</li>
         </ol>
      </div>

      <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
         <div class="video-overlay" style="background: rgba(0,0,0,0.6);"></div>
      </div>

   </section><!-- #page-title end -->
@endsection

@push('scripts')
   <script src="/build/js/jobs/job-payment.min.js"></script>
@endpush

@push('styles')
   <meta name="jt" content="{{$job_token}}" >
@endpush