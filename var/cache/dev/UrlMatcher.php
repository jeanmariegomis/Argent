<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/beneficiaire' => [[['_route' => 'beneficiaire_index', '_controller' => 'App\\Controller\\BeneficiaireController::index'], null, ['GET' => 0], null, true, false, null]],
        '/beneficiaire/new' => [[['_route' => 'beneficiaire_new', '_controller' => 'App\\Controller\\BeneficiaireController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/enregistre' => [[['_route' => 'enregistre', '_controller' => 'App\\Controller\\EntrepriseController::enregistrer'], null, ['POST' => 0], null, false, false, null]],
        '/api/list/entreprise' => [[['_route' => 'list_entreprise', '_controller' => 'App\\Controller\\EntrepriseController::liste'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/utilisateur' => [[['_route' => 'list_utilisateur', '_controller' => 'App\\Controller\\EntrepriseController::lister'], null, ['GET' => 0], null, false, false, null]],
        '/api/utilisateur' => [[['_route' => 'utilisateur', '_controller' => 'App\\Controller\\EntrepriseController::ajouter'], null, ['POST' => 0], null, false, false, null]],
        '/api/entreprise' => [[['_route' => 'entreprise', '_controller' => 'App\\Controller\\EntrepriseController::ajout'], null, ['POST' => 0], null, false, false, null]],
        '/api/depot' => [[['_route' => 'depot', '_controller' => 'App\\Controller\\EntrepriseController::depot'], null, ['POST' => 0], null, false, false, null]],
        '/api/bloque' => [[['_route' => 'bloque', '_controller' => 'App\\Controller\\EntrepriseController::bloque'], null, ['POST' => 0], null, false, false, null]],
        '/expediteur' => [[['_route' => 'expediteur_index', '_controller' => 'App\\Controller\\ExpediteurController::index'], null, ['GET' => 0], null, true, false, null]],
        '/expediteur/new' => [[['_route' => 'expediteur_new', '_controller' => 'App\\Controller\\ExpediteurController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/pdf' => [[['_route' => 'pdf', '_controller' => 'App\\Controller\\PdfController::index'], null, null, null, false, false, null]],
        '/api/register' => [[['_route' => 'register', '_controller' => 'App\\Controller\\SecurityController::register'], null, ['POST' => 0], null, false, false, null]],
        '/api/login_check' => [
            [['_route' => 'login', '_controller' => 'App\\Controller\\SecurityController::login'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_login_check'], null, null, null, false, false, null],
        ],
        '/api/envoi' => [[['_route' => 'tra', '_controller' => 'App\\Controller\\TransactionController::envoi'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/retrait' => [[['_route' => 'add_retrait', '_controller' => 'App\\Controller\\TransactionController::retrait'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/beneficiaire/([^/]++)(?'
                    .'|(*:194)'
                    .'|/edit(*:207)'
                    .'|(*:215)'
                .')'
                .'|/api(?'
                    .'|/bloquer/([^/]++)(*:248)'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:284)'
                    .'|/(?'
                        .'|d(?'
                            .'|ocs(?:\\.([^/]++))?(*:318)'
                            .'|epots(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:352)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:390)'
                                .')'
                            .')'
                        .')'
                        .'|co(?'
                            .'|ntexts/(.+)(?:\\.([^/]++))?(*:432)'
                            .'|mptes(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:466)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:504)'
                                .')'
                            .')'
                        .')'
                        .'|profils(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:543)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:581)'
                            .')'
                        .')'
                        .'|entreprises(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:623)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:661)'
                            .')'
                        .')'
                        .'|transactions(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:704)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:742)'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/expediteur/([^/]++)(?'
                    .'|(*:777)'
                    .'|/edit(*:790)'
                    .'|(*:798)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        194 => [[['_route' => 'beneficiaire_show', '_controller' => 'App\\Controller\\BeneficiaireController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        207 => [[['_route' => 'beneficiaire_edit', '_controller' => 'App\\Controller\\BeneficiaireController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        215 => [[['_route' => 'beneficiaire_delete', '_controller' => 'App\\Controller\\BeneficiaireController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        248 => [[['_route' => 'bloquer', '_controller' => 'App\\Controller\\EntrepriseController::bloquerdebloquer'], ['id'], ['GET' => 0], null, false, true, null]],
        284 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        318 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        352 => [
            [['_route' => 'api_depots_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_depots_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        390 => [
            [['_route' => 'api_depots_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_depots_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_depots_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        432 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        466 => [
            [['_route' => 'api_comptes_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_comptes_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        504 => [
            [['_route' => 'api_comptes_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_comptes_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_comptes_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        543 => [
            [['_route' => 'api_profils_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_profils_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        581 => [
            [['_route' => 'api_profils_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_profils_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_profils_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        623 => [
            [['_route' => 'api_entreprises_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Entreprise', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_entreprises_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Entreprise', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        661 => [
            [['_route' => 'api_entreprises_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Entreprise', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_entreprises_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Entreprise', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_entreprises_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Entreprise', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        704 => [
            [['_route' => 'api_transactions_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_transactions_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        742 => [
            [['_route' => 'api_transactions_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_transactions_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_transactions_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        777 => [[['_route' => 'expediteur_show', '_controller' => 'App\\Controller\\ExpediteurController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        790 => [[['_route' => 'expediteur_edit', '_controller' => 'App\\Controller\\ExpediteurController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        798 => [
            [['_route' => 'expediteur_delete', '_controller' => 'App\\Controller\\ExpediteurController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
