@extends('frontend.partials.master')

@section('content')
   


    <div class="owl-carousel-wrapper">

      

      <div class="box-92819">
        <h1 class="text-white mb-3">Help People in Need.Support and make a Differen</h1>
        <p><a href="#" class="btn btn-primary py-3 px-4 rounded-0">Donate Now</a></p>
      </div>

      <div class="owl-carousel owl-1 ">
        <div class="ftco-cover-1 overlay" style="background-image: url('images/hero_1.jpg');"></div>
        <div class="ftco-cover-1 overlay" style="background-image: url('images/hero_2.jpg');"></div>
        <div class="ftco-cover-1 overlay" style="background-image: url('images/hero_3.jpg');"></div>
        
      </div>
    </div>
    

    <div class="container">
      <div class="feature-29192-wrap d-md-flex" style="margin-top: -20px; position: relative; z-index: 2;">

        <a href="#" class="feature-29192 overlay-danger" style="background-image: url('images/img_3_gray.jpg');">
          <div class="text">
            <span class="meta">Livelihood</span>
            <h3 class="text-cursive text-white h1">Livelihood</h3>
          </div>
        </a>

        <a class="feature-29192 overlay-success" style="background-image: url('images/img_2_gray.jpg');">
          <div class="text">
            <span class="meta">Health</span>
            <h3 class="text-cursive text-white h1">Natural Remedies</h3>
          </div>
        </a>

        <div class="feature-29192 overlay-warning" style="background-image: url('images/img_1_gray.jpg');">
          <div class="text">
            <span class="meta">School</span>
            <h3 class="text-cursive text-white h1">New Class Rooms</h3>
          </div>
        </div>

      </div>
    </div>

    
    
    
    <div class="site-section">
      <div class="container">
        
        <div class="row mb-5 align-items-st">
          <div class="col-md-4">
            <div class="heading-20219">
              <h2 class="title text-cursive">Crisis Category</h2>
            </div>
          </div>
        </div>

        
    <div class="row">

    @foreach($categories as $category)
    
        <div class="col-md-4 mb-4">  
        
            <div class="cause shadow-sm">
                <a href="#" class="cause-link d-block">
                    <img src="images/img_2.jpg" alt="Image" class="img-fluid" loading="lazy" decoding="async">
                    <div class="custom-progress-wrap">
                        <span class="caption">80% complete</span>
                        <div class="custom-progress-inner">
                            <div class="custom-progress bg-primary" style="width: 80%;"></div>
                        </div>
                    </div>
                </a>

                <div class="px-3 pt-3 border-top-0 border border shadow-sm">
                    <span class="badge-primary py-1 small px-2 rounded mb-3 d-inline-block">{{ $category->category_name }}</span>

                    <h3 class="mb-4"><a href="#">{{ $category->description }}</a></h3>

                    <div class="border-top border-light border-bottom py-2 d-flex">
                        <div>Donated</div>
                        <div class="ml-auto">
                            <strong class="text-primary">$32,919</strong>
                        </div>
                    </div>
                </div>

            </div>

        </div> 

    @endforeach
</div>




   

    <div class="site-section bg-image overlay-primary" style="background-image: url('images/img_1.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-md-6">
            <img src="images/img_1.jpg" alt="Image" class="img-fluid shadow" loading="lazy" decoding="async">
          </div>
          <div class="col-md-6">
            <div class="bg-white h-100 p-4 shadow">
              <h3 class="mb-4 text-cursive">Donate Now</h3>
              <form action="#">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Amount in dollar">
                </div>
                <div class="form-group">
                  <input type="submit" value="Donate Now" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        
            <div class="d-md-flex cta-20101 align-self-center bg-light p-5">
              <div class=""><h2 class="text-cursive">Helping the Homeless, Hungry, and Hurtings Children</h2></div>
              <div class="ml-auto"><a href="#" class="btn btn-primary">Donate Now</a></div>
            </div>
        
      </div>
    </div>

    @endsection