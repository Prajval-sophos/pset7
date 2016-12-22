<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="symbol" placeholder="Symbol" type="text"/>
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