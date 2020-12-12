 <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
               <a href="index.html">
               <img src="<?php echo base_url();?>assets/images/EAIMD-LOGO-1.png" class="img-fluid open-logo" alt="">
               <img src="<?php echo base_url();?>assets/images/EAIMD-LOGO-1.png" class="img-fluid collapsed-logo" alt="">
               <!--<span>LMS</span>-->
               </a>
               <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                     <div class="line-menu half start"></div>
                     <div class="line-menu"></div>
                     <div class="line-menu half end"></div>
                  </div>
               </div>
            </div>
        <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li class="iq-menu-title"><i class="ri-separator"></i><span>Main</span></li>
                     <li class="iq-menu-item active">
                         <a href="<?php echo base_url(); ?>index.php/general/dashboard" class="iq-waves-effect" aria-expanded="true"><i class="fa fa-home"></i><span>Dashboard</span></a>
                       
                     </li>
                      <?php  if($this->session->userdata('useracc') != '2'){  ?>
                      <li class="iq-menu-item">
                        <a href="#" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="ri-apps-line"></i><span>Categories</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="ecommerce" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                           <li><a href="<?php echo base_url();?>index.php/courses/courses">View Categories</a></li>
                           
                          <?php if($this->session->userdata('useracc') != '2'){ ?>
                          <li><a href="<?php echo base_url();?>index.php/courses/new_course">Add New Category</a></li>
                          <?php }?>
                          
                        </ul>
                     </li>
                     <?php
                      }
                     ?>
                     
                     <?php  if($this->session->userdata('useracc') != '2'){  ?>
                     <li class="iq-menu-item">
                        <a href="#" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="ri-apps-line"></i><span>Teachers</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="ecommerce" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                           <li><a href="<?php echo base_url();?>index.php/courses/teachers">View Teachers <?php $this->session->userdata('acc_type') ?></a></li>
                           <li><a href="<?php echo base_url();?>index.php/courses/new_teacher">Add New Teacher</a></li>
                        </ul>
                    </li>
                    <?php
                     }
                     ?>
                       <li class="iq-menu-item">
                        <a href="#" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-apps-line"></i><span>Classes</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li><a href="<?php echo base_url();?>index.php/courses/trial_classes">Trial Classes</a></li>
                            <li><a href="<?php echo base_url();?>index.php/courses/follow_classes">Follow Classes</a></li>
                        </ul>
                     </li>
                   
                    <li class="iq-menu-item">
                        <a href="#" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-apps-line"></i><span>Students</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                             <?php  if($this->session->userdata('useracc') != '2'){  ?>
							<li><a href="<?php echo base_url();?>index.php/courses/students">View Students</a></li>
							 <?php } ?>
                             <li><a href="<?php echo base_url();?>index.php/courses/student_booking_trial">Trial Classes</a></li>
                              <li><a href="<?php echo base_url();?>index.php/courses/student_booking_follow">Follow Classes</a></li>
                        </ul>
                     </li>
                     <?php  if($this->session->userdata('useracc') != '2'){  ?>
                     <li class="iq-menu-item">
                        <a href="#" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-apps-line"></i><span>Content</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li><a href="<?php echo base_url();?>index.php/content/videos">Videos</a></li>
                            <li><a href="<?php echo base_url();?>index.php/content/testimonials">Testimonials</a></li>
                        </ul>
                     </li>
                     <?php
                        }
                     ?>
                      <?php  if($this->session->userdata('useracc') != '2'){  ?>
                     <li class="iq-menu-item">
                        <a href="<?php echo base_url();?>index.php/general/logout" class="iq-waves-effect" aria-expanded="false">
                        <i class="ri-logout-box-line"></i><span>Logout</span></a>
                       
                     </li>
                     <?php 
                      }
                      else{
                    ?>
                    <li class="iq-menu-item">
                        <a href="<?php echo base_url();?>index.php/teacher/logout" class="iq-waves-effect" aria-expanded="false">
                        <i class="ri-logout-box-line"></i><span>Logout</span></a>
                    </li>
                    <?php
                      }
                    ?>
                     
                     
                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
        </div>
        <script>
            
        </script>