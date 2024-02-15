<?php include (APPPATH . 'Views/includes/head.php') ?>

<?php include (APPPATH . 'Views/includes/sidebar.php') ?>


<div class="content-wrapper pt-5">
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning">404</h2>
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i>
                    Oops! <?php if (ENVIRONMENT !== 'production') : ?>
                        <?= nl2br(esc($message)) ?>
                    <?php else : ?>
                        <?= lang('Errors.sorryCannotFind') ?>
                    <?php endif; ?></h3>
                <p>
                    We could not find the page you were looking for.
                    Meanwhile, you may <a href="/">return to dashboard</a> or try using the search form.
                </p>

                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.input-group -->
                </form>
            </div>
        </div>
    </section>
</div>

<?php include (APPPATH . 'Views/includes/footer.php') ?>


