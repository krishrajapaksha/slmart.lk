@foreach ($hotdeal as $hotdeal)

<div id="hot-deal" class="section" style="background-image: url(hotdeals/{{ $hotdeal->image }});">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="hot-deal">
            <ul class="hot-deal-countdown"> 
              <li>
                <div>
                  <h3 id="days"></h3>
                  <span>Days</span>
                </div>
              </li>
              <li>
                <div>
                  <h3 id="hours"></h3>
                  <span>Hours</span>
                </div>
              </li>
              <li>
                <div>
                  <h3 id="minutes">34</h3>
                  <span>Mins</span>
                </div>
              </li>
              <li>
                <div>
                  <h3 id="seconds">60</h3>
                  <span>Secs</span>
                </div>
              </li>
            </ul>
           

            <h2 class="text-uppercase"><i class="fa-solid fa-fire icon"></i>{{ $hotdeal->title }}</h2>
            <p>{{ $hotdeal->deal }}</p>
            
            <a class="primary-btn cta-btn" href="{{url('product_details',$hotdeal->product_id)}}">Shop now</a>
          </div>
        </div>
      </div>
    </div>
</div>


<script>
  var endDateTime = new Date("{{ $hotdeal->end_date }} {{ $hotdeal->end_time }}").getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = endDateTime - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the elements with id="days", "hours", "minutes" and "seconds"
    $(".hot-deal-countdown li").eq(0).find("h3").text(days);
    $(".hot-deal-countdown li").eq(1).find("h3").text(hours);
    $(".hot-deal-countdown li").eq(2).find("h3").text(minutes);
    $(".hot-deal-countdown li").eq(3).find("h3").text(seconds);

    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      $(".hot-deal-countdown li h3").text("00");
      $(".hot-deal h2").text("Deal Expired");
      $(".hot-deal p").text("Stay tuned for the next deal.");
    }
  }, 1000);
</script>

@endforeach
