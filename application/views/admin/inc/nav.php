<!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <div class="left-side-logo d-block d-lg-none">
                    <div class="text-center">                        
                        <a href="<?=site_url('admin');?>"><?=appName?></a>
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">
                    
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>

                            <li>
                                <a href="<?=site_url('admin');?>" class="waves-effect">
                                    <i class="dripicons-meter"></i>
                                    <span> Dashboard</span>
                                </a>
                            </li>

                            <li class="">
                                <a href="<?=site_url('admin/administrators');?>" class="waves-effect"><i class="dripicons-briefcase"></i> <span> Administrators </span></a>                                
                            </li>                            
                            <li class="">
                                <a href="<?=site_url('admin/airplaneType');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Airplane Type </span></a>                                
                            </li>   
                            <li class="">
                                <a href="<?=site_url('admin/airplanes');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Airplanes </span></a>                                
                            </li>  
                            <li class="">
                                <a href="<?=site_url('admin/ratings');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Rating </span></a>                                
                            </li> 
                            <li class="">
                                <a href="<?=site_url('admin/employees');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Employee </span></a>                                
                            </li>  
                             <li class="">
                                <a href="<?=site_url('admin/flights');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Flight </span></a>                                
                            </li> 
                            <li class="">
                                <a href="<?=site_url('admin/schedules');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Schedules </span></a>                                
                            </li>  
                            <li class="">
                                <a href="<?=site_url('admin/crews');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Crews </span></a>                                
                            </li>     
                            <li class="">
                                <a href="<?=site_url('admin/passengers');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Passengers </span></a>                                
                            </li>   
                            <li class="">
                                <a href="<?=site_url('admin/booking');?>" class="waves-effect"><i class="dripicons-map"></i> <span> Bookings </span></a>                                
                            </li>                            
                           
                            <li>
                                <a href="<?=site_url('admin/logout');?>" class="waves-effect">
                                    <i class="dripicons-exit"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->