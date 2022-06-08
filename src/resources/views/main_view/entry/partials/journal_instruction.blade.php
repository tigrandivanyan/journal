<div class="operator-instruction-wrapper">
    <div class="operator-instruction">
        <button type="button" id="instructionHideBtn" class="btn btn-xs">Закрыть</button>

        <span id="instruction">
            <small class="form-text text-muted">
                <?php
                    $notice = str_replace("&lt;", "<", $notice->content);
                    $notice = str_replace("&gt;", ">", $notice);
                    echo $notice;
                ?>
            </small>
        </span>

        <div class="operator-instruction-text">
            <?php
                $instruction = str_replace("&lt;", "<", $instruction->content);
                $instruction = str_replace("&gt;", ">", $instruction);
                echo $instruction;
            ?>
        </div>
    </div>
</div>