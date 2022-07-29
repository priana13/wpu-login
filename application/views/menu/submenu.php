<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?> </h1>

    <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newSubmenu">Add New Sub Menu</a>

    <div class="row mt-2">

        <div class="col">

        <?php if(validation_errors()) : ?>

          <div class="alert alert-danger">
            <?= validation_errors();  ?>
          </div>
          
        <?php endif; ?>

        <?=
            form_error('menu' , '<div class="alert alert-danger" role="alert">',
          '</div>');
        ?>
        
        <?= $this->session->flashdata('message'); ?>
        
        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Menu</th>
            <th scope="col">Url</th>
            <th scope="col">Icon</th>
            <th scope="col">Active</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach ($subMenu as $sm) { ?>
            <tr>
            <th scope="row"><?= $i ; ?></th>
            <td><?= $sm['title']; ?></td>
            <td><?= $sm['menu']; ?></td>
            <td><?= $sm['field_url']; ?></td>
            <td><?= $sm['icon']; ?></td>
            <td><?= $sm['is_active']; ?></td>
            <td>
            <form action="<?= base_url('menu/delete_submenu') ?>" method="post">

                <a href="" class="btn btn-success btn-sm">Edit</a>

                <input type="hidden" name="id" value="<?= $sm['id']; ?>">

                <button type="submit" class="btn btn-danger btn-sm">delete</button>

                </form>
            </td>  

            </tr>
        <?php $i++; } ?>
        </tbody>
        </table>

        </div>
    </div>


</div>
<!-- /.container-fluid -->



<!-- Modal -->
<div class="modal fade" id="newSubmenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Menu Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="post">
      <div class="modal-body">

        <div class="form-group">       
            <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
        </div>

        <div class="form-group">       
            <select class="form-control" name="menu_id" id="menu_id">
              <option value="">Select Menu</option>
              <?php foreach($menu as $m) : ?>
              
                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
              <?php endforeach; ?>

            </select>
        </div>

        <div class="form-group">       
            <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu url">
        </div>

        <div class="form-group">       
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu icon">
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
          <label class="form-check-label" for="is_active">
            Aktive?
          </label>
        </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>

      </form>

    </div>
  </div>
</div>

</div>
<!-- End of Main Content -->

<!--