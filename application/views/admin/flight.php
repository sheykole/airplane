<script type="text/javascript">
function edit(id = null)
{   

    $('#edit')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    if(id == null)
    {
         $('#editform').modal('show'); // show bootstrap modal
         $('.modal-title').text('Add Flight'); // Set Title to Bootstrap modal title
    }
    else
    {
        $.ajax({
                url : "<?php echo site_url('admin/flight_edit/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    $('[name="id"]').val(data.flightnum);
                    $('[name="flightdate"]').val(data.flightdate);
                    $('[name="origin"]').val(data.origin);
                    $('[name="destination"]').val(data.destination);
                    $('[name="amount"]').val(data.amount);
                    $('[name="status"]').val(data.status);
                    $('#editform').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Edit Flight'); // Set Title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
    }
     
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
        url = "<?php echo site_url('admin/flight_update')?>";
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#edit').serialize(),
        dataType: "JSON",
        success: function(data)
        {           
            if(data.status) //if success close modal and reload ajax table
            {
                $('#editform').modal('hide');
                setTimeout(function(){// wait for 5 secs(2)
                                       window.location.reload(); // then reload the page.(3)
                                  }, 500); 
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
</script>
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">List of Flights <button type="button" class="btn btn-primary btn-xs" data-original-title="Edit User" onclick="edit()">
                                    Add Flight</i>
                                </button></h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>S/NO</th>
                            <th>Flight Num</th>
                            <th>Date</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Amount</th>
                            <th>Passengers</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($flight != '') { $i=0; foreach($flight as $r){ 
                            $d = $this->book_m->record_count(array('flightnum'=>$r->flightnum));
                            ?>
                            <tr>
                                <td><?=$i+=1;?></td>
                                <td><?=$r->flightnum;?></td>
                                <td><?=date('d-m-Y',strtotime($r->flightdate));?></td>
                                <td><?=$r->origin;?></td>
                                <td><?=$r->destination;?></td>
                                <td>$<?=number_format($r->amount,2);?></td>
                                <td><?=$d?></td>
                                <td><?=$r->status?></td>
                                <td>
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs" data-original-title="Edit User" onclick="edit(<?=$r->flightnum;?>)">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </div>
                                </td>
                            </tr>

                        <?php } } ?>

                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade" id="editform" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit</span> 
                    <span class="fw-light">
                        Details
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Edit the details of the flight using this form, make sure you fill them all</p>
                <form action="#" id="edit">
                    <input type="hidden"  name="id"/>
                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Flight Number (integer)</label>
                                <input id="addName" name="flightnum" type="hidden" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Date</label>
                                <input id="addName" name="flightdate" type="date" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Origin</label>
                                <input id="addName" name="origin" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Destination</label>
                                <input id="addName" name="destination" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Amount</label>
                                <input id="addName" name="amount" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>