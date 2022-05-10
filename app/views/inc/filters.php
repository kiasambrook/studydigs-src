<?
function callFilters($formAction){

    ?>
    <!-- Filters -->
    <div class="border rounded-0 shadow-sm bg-light p-4 border-1" id="sidebar">
                        <h4>Filter search</h4>
                        <p>Use the filters below to narrow your search.</p>
                        <form action="<? echo URLROOT . $formAction;?>" method="POST">
                        <h6 class="mt-3">Number of bedrooms</h6>
                            <div id="bedrooms" class="input-group">
                                <select class="form-select mx-1" name="min_bedrooms">
                                    <optgroup label="Min bedrooms">
                                        <option value="any">Any</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </optgroup>
                                </select>
                                <select class="form-select mx-1" name="max_bedrooms">
                                    <optgroup label="Max bedrooms">
                                        <option value="any">Any</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </optgroup>
                                </select>
                            </div>
                            <h6 class="mt-3">Number of bathrooms</h6>
                            <select name="bathrooms" class="form-select mx-1 form-control form-select w-50"
                                id="bathrooms">
                                <optgroup label="Bathrooms">
                                    <option value="any">Any</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </optgroup>
                            </select>
                            <h6 class="mt-3">Price Per Month (Per person)</h6>
                            <select name="rent" class="form-select mx-1 form-control form-select w-50">
                                <optgroup label="Max price">
                                    <option value="any" selected="">Any</option>
                                    <option value="100">£100</option>
                                    <option value="200">£200</option>
                                    <option value="300">£300</option>
                                    <option value="400">£400</option>
                                    <option value="500">£500</option>
                                    <option value="750">£750</option>
                                    <option value="1000">£1000</option>
                                    <option value="1500">£1500</option>
                                    <option value="3000">£3000</option>
                                </optgroup>
                            </select>
                            <h6 class="mt-3">Extras amenities&nbsp;</h6>
                            <div id="checkboxes" class="row text-start">
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="bills" id="bills-included">
                                    <label class="form-check-label" for="bills-included">Bills included</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="wifi">
                                    <label class="form-check-label" for="wifi">WiFi</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="parking">
                                    <label class="form-check-label" for="car-space">Parking space</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="dual_occupancy"><label
                                        class="form-check-label" for="dual_occupancy">Dual
                                        occupancy</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="pets">
                                    <label class="form-check-label" for="pets">Pets</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="washing">
                                    <label class="form-check-label" for="washing">Washing
                                        machine</label>
                                </div>
                            </div>

                            <!-- filter buttons -->
                            <div class="btn-group mt-4" role="group">
                                <input class="btn btn-primary me-2 rounded-1 border-0 text-light" type="submit"
                                    value="Apply"></input>
                                <button class="btn btn-danger rounded-1 border-0" type="reset">Clear</button>
                            </div>
                        </form>
                    </div>

<?}