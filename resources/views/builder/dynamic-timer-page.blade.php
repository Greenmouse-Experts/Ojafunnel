<!DOCTYPE html>
<head>
        <meta charset="utf-8"><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>$title</title>
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTDNEpUTHQoQUJMHLrErGJyHg89uy71MyuHNTKfAdVQSZe" crossorigin="anonymous"></script>
        <style>
            html, body
            {
                width:100%;
                height:100%;
            }

            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                background: #000;
                min-height: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .footer p {
                color: #fff;
                margin: 5px 0 5px 0;
                font-size: 0.6rem;
                font-weight: 300;
            }
        </style>
        <style id="vvvebjs-styles"></style>
    </head>

    <body data-new-gr-c-s-check-loaded="14.1120.0" data-gr-ext-installed="" data-new-gr-c-s-loaded="14.1116.0">
        <!-- Page Content -->
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-12 text-center">
                <h1 class="mt-5"> Ojafunnel Dynamic Timer Sales Page</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                  <div style="height: 100px;padding: 30px; border: 1px solid #bbb; width: 200px; margin: 0 auto;"><h2>$product_name</h2></div>
                    <p class="lead">Please fill out the form to get you onboarded.</p>
                </div>
            </div>
            <div style="margin: 0 auto; width: 100%;">
                <center>
                  <span id="amt" style="font-size: 30px; font-weight: bold;border: none;text-align: center;width: inherit;">$product_price</span>
              </center>
              <center>
                <span id="timer" style="font-size: 17px; color: red; font-weight: 700">00:00:00</span>
                <input type="hidden" id="d" value="$timer" />
                <input type="hidden" id="rate" value="$rate"/>
              </center>
            </div>
            <div>
                <div class="col-lg-6" style="margin: 0 auto;">
                    <form id="offer_form" method="POST" action="http://localhost:8000/form-submission/eyJpdiI6InNQcGtqVlRMRisyVTNqUEEzVU9pYUE9PSIsInZhbHVlIjoiVnBWcExHY3lPeE9LRlZpU0RheVkrdz09IiwibWFjIjoiYTFmZmNkOTc1YjFkYWJmZDY5ZGRjY2U3OTg5MTcyODhhYWYzODhlZjU5OWY5NjE0YjM1N2ZhNzdkYzBhZTZkMiIsInRhZyI6IiJ9">
                        <div class="form-group">
                            <lable>Full name</lable>
                            <input type="text" class="form-control" name="name" style="">
                        </div>
                        <div class="form-group mt-3">
                            <lable>Email addres</lable>
                            <input type="text" class="form-control" name="email" style="">
                        </div>
                        <div class="form-group mt-3">
                            <lable>Phone number</lable>
                            <input type="text" class="form-control" name="phone" style="">
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <footer class="footer">
            <p>Built with <a href="https://ojafunnel.com" class="text-white">Ojafunnel</a></p>
        </footer>

        <grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

      <script type="text/javascript">

        var rate = document.getElementById("rate").value;
        var amt = document.getElementById("amt").innerHTML;
        var uri = document.getElementById("offer_form").getAttribute("action");

        amt = amt.replace(",", "");
        amt = amt.replace(".", "");
        amt = Number.parseInt(amt)/100;
        rate = Number.parseInt(rate)/100;
        var new_amt = amt + (amt*rate);

        let dollarUSLocale = Intl.NumberFormat('en-US');
        new_amt = dollarUSLocale.format(new_amt) + "";
        var de = false;

        setInterval(function () {
          var starttime = localStorage.getItem("stime") || null;
          var deadline = null;


          const dr = document.getElementById("d").value;
          if(!starttime) {

              let now  = new Date().getTime();
              localStorage.setItem("stime", now);
          }

          var starttime = Number.parseInt(localStorage.getItem("stime"));
          var odate = new Date(starttime);

          var ddl = new Date(odate);
          ddl.setDate(odate.getDate() + 1);

          let now = new Date().getTime();

          var t = ddl.getTime() - now;

          if(t >= 0) {
              let days = Math.floor(t / (1000 * 60 * 60 * 24));
              let hours = Math.floor(
                  (t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              let minutes = Math.floor(
                  (t % (1000 * 60 * 60)) / (1000 * 60));
              let seconds = Math.floor(
                  (t % (1000 * 60)) / 1000);

             document.getElementById("timer").innerHTML = "(" +
                    days + "d " + hours + "h " +
                    minutes + "m " + seconds + "s) ";
          } else {
            de = true;
        	  if(de) {
        		document.getElementById("offer_form").setAttribute("action", uri + "&ext=1");
        	   }
        	  document.getElementById("timer").innerHTML = "";
              document.getElementById("amt").innerHTML = new_amt;
          }
        }, 1000);
      </script>
</body>
</html>
