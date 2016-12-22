<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select autofocus class="form-control" name="symbol">
                <option disabled selected value="">Symbol</option>
                <?php
                    foreach($stocks as $stock)
                    {
                        print("<option value =". $stock["symbol"].">".strtoupper($stock["symbol"])."</option>");
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" ></span>
                Sell
            </button>
        </div>
    </fieldset>
</form>