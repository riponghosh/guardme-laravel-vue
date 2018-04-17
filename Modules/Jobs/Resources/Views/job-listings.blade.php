@extends('app::layouts.site')

@section('content')
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="col_three_fifth nobottommargin listings">
            <div class="listing-item" v-for="job in jobs.data" :class="{'ui loading' : jobs.loading}">

               <div class="row">
                  <div class="col-sm-9">
                     <div class="fancy-title title-bottom-border">
                        <h3 class="uk-text-truncate">
                           <a :href="'/jobs/' + job.slug">
                              @{{ job.title }}
                           </a>
                        </h3>
                     </div>

                     <div class="mb-3 mt-0">
                        <span v-for="category in job.categories" class="d-inline-block mr-3">
                           <i class="tag icon"></i>
                           @{{ category.name }}
                        </span>
                     </div>

                     <p class="list-description" v-html="job.description"></p>

                     <div class="mt-3">
                        @if(hasRole(config('guardme.acl.Job_Seeker')))
                        <a class="ui label tiny black"
                           v-if="!job.applied"
                           @click="submitApplication(job)">
                           Apply Now
                        </a>
                           <span v-else class="ui success image label tiny">
                              <i class="icon check"></i> applied
                           </span>
                        @endif

                        <span class="ui blue image label tiny">
                           £@{{ job.offer }}
                           <div class="detail">Hourly</div>
                        </span>

                        <a :href="'/jobs/' + job.slug" class="ui label tiny green">
                           <i class="eye icon"></i>
                           See details
                        </a>
                     </div>
                  </div>
               </div>

               <div class="divider divider-short"><i class="icon-star3"></i></div>
            </div>
         </div>

         <div class="col_two_fifth nobottommargin col_last px-5">

            <div class="col_full">
               <h5>Apply Filter:</h5>
            </div>

            <div class="col_full">
               <label>Offer:</label>
               <input class="offer_range_slider" />
            </div>
            <div class="col_full">
               <label>Date:</label>
               <input type="datetime" name="daterange" value="" />
            </div>

            <div class="col_full">
               <label>Category: <small class="uk-text-meta">(Choose all that apply)</small></label>
               <div class="fluid d-flex justify-content-between row">
                  <div class="inline field col-6" v-for="category in categories.data">
                     <div class="ui checkbox">
                        <input type="checkbox" :value="category.id" name="categories"
                               tabindex="0" class="hidden" v-model="filter.categories">
                        <label>@{{ category.name }}</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="ui modal small application" style="bottom: unset;">
      <div class="header">Apply to job</div>
      <div class="content">
         <form class="ui form px-3"
               @submit.prevent="submitBid()"
               data-vv-scope="application-form">
            <div class="row">
               <div class="col-sm-6">
                  <h3>
                     @{{ selectedJob ? selectedJob.title : ''}}
                  </h3>
                  <p v-html="selectedJob ? selectedJob.description : ''"></p>
               </div>
               <div class="col-sm-5 offset-1">
                  <div class="row">
                     <div class="col_full">
                        <label class="t400">Offer (£):</label>
                        <input type="text" placeholder="" :value="selectedJob ? selectedJob.offer : 0"
                               disabled class="form-control" />
                     </div>

                     <div class="col_full">
                        <label class="t400">Your bid (£):</label>
                        <input type="text" name="bid" placeholder=""
                               v-model.number="application.bid" class="form-control" />
                     </div>

                     <div class="field my-3">
                        <button class="ui button primary float-none mini" type="submit">
                           Submit Bid <i class="icon check circle"></i>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('feature')
   <!-- Page Title
		============================================= -->
   <section id="page-title" class="page-title-parallax page-title-dark page-title-center"
            style="background: url('/assets/img/security_lady_man.jpg') no-repeat center center / cover; padding: 90px 0;"
            data-stellar-background-ratio="1">

      <div class="container clearfix">
         <h1>Job Listings</h1>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Job Listing</li>
         </ol>
      </div>

      <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
         <div class="video-overlay" style="background: rgba(0,0,0,0.8);"></div>
      </div>

   </section><!-- #page-title end -->
@endsection

@push('scripts')
   <script src="/build/js/jobs/job-listings.min.js"></script>

   <script>

   </script>
@endpush

@push('styles')

@endpush