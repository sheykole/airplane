<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">List of Bookings</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>S/NO</th>
                            <th>Flights</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result != '') { $i=0; foreach($result as $r){ 
                            ?>
                            <tr>
                                <td><?=$i+=1;?></td>
                                <td><?=dbInfo('flight_m','flightnum',$r->flightnum,'origin').' '.dbInfo('flight_m','flightnum',$r->flightnum,'destination');?></td>
                            </tr>

                        <?php } } ?>

                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
