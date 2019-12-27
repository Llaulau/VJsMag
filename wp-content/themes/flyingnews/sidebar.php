<?php if (is_active_sidebar(jwLayout::sidebar())) { ?>
    <aside id="sidebar" class="four columns <?php echo jwLayout::sidebar_layout(); ?>" role="complementary"> <!-- Start Sidebar -->
        <div class="sidebar-box">

            <?php
            jwSidebars::render(jwLayout::sidebar());
            ?>	 

        </div>
    </aside><!-- End Sidebar -->
<?php } ?>


