<?php

use App\Manager\UserServiceManager;
use Model\DB;

class SearchController extends Controller {

    /**
     * Proceed to search with provided search data.
     * @param array $request
     */
    public function search(array $request) {
        $services = [];
        $criteria = DB::secureData($request['search-criteria']);
        $searchText = DB::secureData($request["search-text"]);

        if(strlen($searchText) > 0 && strlen($criteria) > 0) {
            $userServiceManager = new UserServiceManager();
            $services = $userServiceManager->search($criteria, $searchText, true);
        }
        else {
            $this->setErrorMessage("Tous les champs de recherche n'ont pas été spécifiés.");
        }

        $this->addCss(['search.css', 'forms.css']);
        $this->showView('service/allServices', [
            'search-title' => $searchText,
            'services' => $services,
        ]);
    }
}