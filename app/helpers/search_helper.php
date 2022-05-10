<?php 

/**
 * Filter the array to only include properties that match the required filters.
 *
 * @param Array $items - The array to filter.
 * @param Array $filters - The filters to compare with.
 * @return True if successful
 */
function filterProperties($items, $filters){
    return array_filter($items, function($item) use ($filters) {
        if(($item['bedrooms'] >= $filters['min_bedrooms'] || $filters['min_bedrooms'] == 0) &&
        ($item['bedrooms'] <= $filters['max_bedrooms'] || $filters['max_bedrooms'] == 0) &&
        ($item['bathrooms'] == $filters['bathrooms']  || $filters['bathrooms'] == 0) &&
        ($item['monthly_cost'] <= $filters['monthly_cost'] || $filters['monthly_cost'] == 0 )&&
        ($item['bills_included'] == $filters['bills_included'] || $filters['bills_included'] == 0 )&&
        ($item['parking_space'] == $filters['parking_space'] || $filters['parking_space'] == 0 )&&
        ($item['wifi'] == $filters['wifi'] || $filters['wifi'] == 0 )&&
        ($item['pets'] == $filters['pets'] || $filters['pets'] == 0 )&&
        ($item['dual_occupancy'] == $filters['dual_occupancy'] || $filters['dual_occupancy'] == 0 )&&
        ($item['washing_machine'] == $filters['washing_machine']|| $filters['washing_machine'] == 0 )){
            return true;
        }
    });

}