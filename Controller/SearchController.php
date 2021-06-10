<?php

use App\Manager\UserServiceManager;
use Model\DB;

class SearchController extends Controller {

    /**
     * Proceed to search with provided search data.
     * @param array $request
     */
    public function search(array $request) {
        $criteria = DB::secureInt($request['search-criteria']);

        if($criteria >= 0 && $criteria <= 2) {
            // 0 = by country ; 1 = by title ; 2 = by user.
            switch ($criteria) {
                case 0:
                    $column = 'country';
                    break;
                case 1:
                    $column = 'user_fk';
                    break;
                case 2 :
                    $column = 'title';
                    break;
            }

            $searchText = DB::secureData($request["search"]);

            $userServiceManager = new UserServiceManager();
            $services = $userServiceManager->search($criteria, $searchText, true);
        }
        else {
            $services = []; // Empty service list so I can notify user "No services found".
            $this->setErrorMessage("Vous devez fournir un critère de recherche");
        }
        $this->addCss(['search.css', 'forms.css']);
        $this->showView('service/allServices', [
            'services' => $services,
        ]);
    }
}