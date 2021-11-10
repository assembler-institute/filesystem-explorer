  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload file</h5>
                  <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="alert alert-primary" role="alert">
                      <form id="formFile" class="mb-0" action="" method="post" enctype="multipart/form-data">
                          <h3>Select file to upload:</h3>
                          <span>Max file size 100 Mb</span>
                          <input type="file" name="file" id="file">

                          <div class="modal-footer">
                              <input type="submit" class="btn btn-success" value="Upload" name="submit" data-bs-dismiss="modal">

                          </div>
                      </form>
                  </div>

              </div>

          </div>
      </div>
  </div>

  <script>
      $(document).ready(function() {
          //?eventListener Upload
          $("#formFile").submit(function() {
              ajaxUpload();
          })
      })
  </script>
