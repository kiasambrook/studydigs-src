<?
function deleteModal($item, $id, $deleteFunction)
{

?>

  <!-- Delete item modal -->
    <div class="modal fade" id="deleteModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        Are you sure you want to delete <? echo $item;?>
                        <? echo $id; ?>?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-danger border-0">
                    This action cannot be undone.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a type="button" href="<? echo URLROOT . $deleteFunction . $id; ?>" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>
<? } ?>

<?
function infoModal($header="", $body, $footer, $modalName)
{
?>
  <!-- image modal -->
    <div class="modal fade" id="<? echo $modalName;?>" tabindex="-1" aria-labelledby="<? echo $modalName;?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <? echo $header; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <? echo $body; ?>
                </div>
                <div class="modal-footer">
                     <? echo $footer; ?>
                </div>
            </div>
        </div>
    </div>
<? } ?>
