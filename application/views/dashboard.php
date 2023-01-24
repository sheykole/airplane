<script type="text/javascript">

  function getunit(t)
    {
        if(t == 'buy')
          var i = $('#unit').val();  
        else
            var i = $('#unitS').val();     
        if(i != '' && i != '.' && i.substr(-1) !='.') {
          //if()
          //alert(i);
            $.ajax({
            url : "<?=site_url('app/getCurrentBTC/')?>" + t + "/"+i,
            type: "GET",
            dataType: "JSON",
            success: function(result)
            {
                //alert(result);
                if(result != null)
                {
                    //alert(result.value);
                    var name = result.value;
                    var ng = result.ngn;
                    internationalNumberFormat = new Intl.NumberFormat('en-US');
                    if(t == 'buy')
                    {
                      $('#amount').val(internationalNumberFormat.format(name));
                      $('#ng').val(internationalNumberFormat.format(ng));
                    }
                    else
                    {
                      $('#amountS').val(internationalNumberFormat.format(name));
                      $('#ngS').val(internationalNumberFormat.format(ng));
                    }
                    

                }
                else
                {
                    swal(
                        {
                            icon: 'error',
                            title: 'Oops...',
                            text: 'You enter a wrong value',
                            type: 'error',
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger m-l-10'
                        }
                    );
                    $('#unit').val(''); 
                    $('#amount').val(''); 
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal(
                    {
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You enter a wrong value',
                        type: 'error',
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger m-l-10'
                    }
                );
                $('#unit').val(''); 
                $('#amount').val(''); 
            }
        });
        }
        else if(i == '')
        {
          $('#amount').val(''); 
          $('#amountS').val(''); 
        }
    }
</script>
<section class="simple-head" data-stellar-background-ratio="0.5" id="hme"> 
  <!-- Particles -->
  <div id="particles-js"></div>
  <div class="position-center-center cont-left">
    <div class="container">
      <div class="row"> 

        <!-- Left Section -->
        <div class="col-md-7" style="padding-top: 50px;">
          <h1>Buy & Sell Crytocurrency</h1>
          <p>Hello</p>
          <a href="#." class="btn">Join Us</a> <a href="#." class="btn btn-inverse">View White Paper</a> </div>
          
          <!-- Text Section -->
          <div class="col-md-5">
            <div class="card mt-3 tab-card">
              <div class="card-header tab-card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Buy</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="one-tab" data-toggle="tab" href="#two" role="tab" aria-controls="One" aria-selected="true">Sell</a>
                  </li>
                </ul>
              </div>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                  <form method="post" action="">
                    <input type="hidden" name="type" value="buy">
                  <p style="color:#000;">Rate: $1 - N<?=$this->session->userdata('buy');?></p>
                  <h5 class="card-title">Unit to Buy. </h5>
                  
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="unit" id="unit" onkeyup="getunit('buy')">
                    <span class="input-group-text">.00</span>
                  </div>  
                  <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control" id="amount" aria-label="Amount (to the nearest dollar)" readonly>
                    <span class="input-group-text">.00</span>
                  </div> 
                  <div class="input-group mb-3">
                    <span class="input-group-text">&#8358;</span>
                    <input type="text" class="form-control" id="ng" aria-label="Amount (to the nearest Naira)" readonly>
                    <span class="input-group-text">.00</span>
                  </div> 
                   <div class="form-group mb-3">
                      <input type="submit" name="" class="btn btn-primary">
                  </div>
                  </form>           
                </div>
                <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                <form method="post" action="">
                  <input type="hidden" name="type" value="sell">
                  <p style="color:#000;">$1 - N<?=$this->session->userdata('sell');?></p>
                  <h5 class="card-title">Unit to Sell. </h5>
                  
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="unit" id="unitS" onkeyup="getunit('sell')">
                    <span class="input-group-text">.00</span>
                  </div>  
                  <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control" id="amountS" aria-label="Amount (to the nearest dollar)" readonly>
                    <span class="input-group-text">.00</span>
                  </div> 
                  <div class="input-group mb-3">
                    <span class="input-group-text">&#8358;</span>
                    <input type="text" class="form-control" id="ngS" aria-label="Amount (to the nearest Naira)" readonly>
                    <span class="input-group-text">.00</span>
                  </div> 
                   <div class="form-group mb-3">
                      <input type="submit" name="" class="btn btn-primary">
                  </div>
                  </form>           
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
                </div>