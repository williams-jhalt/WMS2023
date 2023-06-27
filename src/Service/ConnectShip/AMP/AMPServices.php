<?php

namespace App\Service\ConnectShip\AMP;

class AMPServices extends \SoapClient {

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array(
        'Commitment' => 'ConnectshipBundle\\AMP\\Commitment',
        'Dimensions' => 'ConnectshipBundle\\AMP\\Dimensions',
        'Group' => 'ConnectshipBundle\\AMP\\Group',
        'Identity' => 'ConnectshipBundle\\AMP\\Identity',
        'Money' => 'ConnectshipBundle\\AMP\\Money',
        'HazmatQuantity' => 'ConnectshipBundle\\AMP\\HazmatQuantity',
        'NameAddress' => 'ConnectshipBundle\\AMP\\NameAddress',
        'PrintArea' => 'ConnectshipBundle\\AMP\\PrintArea',
        'ShipperInformation' => 'ConnectshipBundle\\AMP\\ShipperInformation',
        'PrintAreaList' => 'ConnectshipBundle\\AMP\\PrintAreaList',
        'StockDescriptor' => 'ConnectshipBundle\\AMP\\StockDescriptor',
        'Volume' => 'ConnectshipBundle\\AMP\\Volume',
        'Weight' => 'ConnectshipBundle\\AMP\\Weight',
        'Holiday' => 'ConnectshipBundle\\AMP\\Holiday',
        'CollectionBase' => 'ConnectshipBundle\\AMP\\CollectionBase',
        'List' => 'ConnectshipBundle\\AMP\\ListCustom',
        'DictionaryItem' => 'ConnectshipBundle\\AMP\\DictionaryItem',
        'Dictionary' => 'ConnectshipBundle\\AMP\\Dictionary',
        'StringList' => 'ConnectshipBundle\\AMP\\StringList',
        'IntegerList' => 'ConnectshipBundle\\AMP\\IntegerList',
        'IdentityList' => 'ConnectshipBundle\\AMP\\IdentityList',
        'DataDictionaryList' => 'ConnectshipBundle\\AMP\\DataDictionaryList',
        'Commodity' => 'ConnectshipBundle\\AMP\\Commodity',
        'CommodityList' => 'ConnectshipBundle\\AMP\\CommodityList',
        'HazmatItem' => 'ConnectshipBundle\\AMP\\HazmatItem',
        'HazmatItemList' => 'ConnectshipBundle\\AMP\\HazmatItemList',
        'AlcoholItem' => 'ConnectshipBundle\\AMP\\AlcoholItem',
        'AlcoholItemList' => 'ConnectshipBundle\\AMP\\AlcoholItemList',
        'DataDictionary' => 'ConnectshipBundle\\AMP\\DataDictionary',
        'Result' => 'ConnectshipBundle\\AMP\\Result',
        'IdentityListResult' => 'ConnectshipBundle\\AMP\\IdentityListResult',
        'GroupResult' => 'ConnectshipBundle\\AMP\\GroupResult',
        'ShipperResult' => 'ConnectshipBundle\\AMP\\ShipperResult',
        'StringResult' => 'ConnectshipBundle\\AMP\\StringResult',
        'BooleanResult' => 'ConnectshipBundle\\AMP\\BooleanResult',
        'IdentityResult' => 'ConnectshipBundle\\AMP\\IdentityResult',
        'DictionaryResult' => 'ConnectshipBundle\\AMP\\DictionaryResult',
        'PackageResult' => 'ConnectshipBundle\\AMP\\PackageResult',
        'PackageResultList' => 'ConnectshipBundle\\AMP\\PackageResultList',
        'ProcessResult' => 'ConnectshipBundle\\AMP\\ProcessResult',
        'ProcessResultList' => 'ConnectshipBundle\\AMP\\ProcessResultList',
        'RateResult' => 'ConnectshipBundle\\AMP\\RateResult',
        'ImageItemList' => 'ConnectshipBundle\\AMP\\ImageItemList',
        'OutputItemList' => 'ConnectshipBundle\\AMP\\OutputItemList',
        'DocumentOutput' => 'ConnectshipBundle\\AMP\\DocumentOutput',
        'PrintItem' => 'ConnectshipBundle\\AMP\\PrintItem',
        'DocumentResult' => 'ConnectshipBundle\\AMP\\DocumentResult',
        'DocumentResultList' => 'ConnectshipBundle\\AMP\\DocumentResultList',
        'PrintResult' => 'ConnectshipBundle\\AMP\\PrintResult',
        'VoidPackageResult' => 'ConnectshipBundle\\AMP\\VoidPackageResult',
        'VoidPackageResultList' => 'ConnectshipBundle\\AMP\\VoidPackageResultList',
        'VoidResult' => 'ConnectshipBundle\\AMP\\VoidResult',
        'SearchPackageResult' => 'ConnectshipBundle\\AMP\\SearchPackageResult',
        'SearchPackageResultList' => 'ConnectshipBundle\\AMP\\SearchPackageResultList',
        'SearchResult' => 'ConnectshipBundle\\AMP\\SearchResult',
        'ShipFile' => 'ConnectshipBundle\\AMP\\ShipFile',
        'TransmitItem' => 'ConnectshipBundle\\AMP\\TransmitItem',
        'TransmitItemList' => 'ConnectshipBundle\\AMP\\TransmitItemList',
        'CloseOutResult' => 'ConnectshipBundle\\AMP\\CloseOutResult',
        'TransmitItemResult' => 'ConnectshipBundle\\AMP\\TransmitItemResult',
        'TransmitItemResultList' => 'ConnectshipBundle\\AMP\\TransmitItemResultList',
        'TransmitResult' => 'ConnectshipBundle\\AMP\\TransmitResult',
        'ModifyPackageResult' => 'ConnectshipBundle\\AMP\\ModifyPackageResult',
        'ModifyPackageResultList' => 'ConnectshipBundle\\AMP\\ModifyPackageResultList',
        'ModifyPackagesResult' => 'ConnectshipBundle\\AMP\\ModifyPackagesResult',
        'CandidateAddress' => 'ConnectshipBundle\\AMP\\CandidateAddress',
        'CandidateAddressList' => 'ConnectshipBundle\\AMP\\CandidateAddressList',
        'ValidateResult' => 'ConnectshipBundle\\AMP\\ValidateResult',
        'StockDescriptorList' => 'ConnectshipBundle\\AMP\\StockDescriptorList',
        'ListStocksResult' => 'ConnectshipBundle\\AMP\\ListStocksResult',
        'GroupList' => 'ConnectshipBundle\\AMP\\GroupList',
        'ListGroupsResult' => 'ConnectshipBundle\\AMP\\ListGroupsResult',
        'ListTransmitItemsResult' => 'ConnectshipBundle\\AMP\\ListTransmitItemsResult',
        'ShipFileList' => 'ConnectshipBundle\\AMP\\ShipFileList',
        'ListShipFilesResult' => 'ConnectshipBundle\\AMP\\ListShipFilesResult',
        'StringListResult' => 'ConnectshipBundle\\AMP\\StringListResult',
        'HolidayItem' => 'ConnectshipBundle\\AMP\\HolidayItem',
        'HolidayDictionary' => 'ConnectshipBundle\\AMP\\HolidayDictionary',
        'HolidayList' => 'ConnectshipBundle\\AMP\\HolidayList',
        'ListHolidaysResult' => 'ConnectshipBundle\\AMP\\ListHolidaysResult',
        'CloseOutRequest' => 'ConnectshipBundle\\AMP\\CloseOutRequest',
        'CloseOutResponse' => 'ConnectshipBundle\\AMP\\CloseOutResponse',
        'CreateGroupRequest' => 'ConnectshipBundle\\AMP\\CreateGroupRequest',
        'CreateGroupResponse' => 'ConnectshipBundle\\AMP\\CreateGroupResponse',
        'CustomOperationRequest' => 'ConnectshipBundle\\AMP\\CustomOperationRequest',
        'CustomOperationResponse' => 'ConnectshipBundle\\AMP\\CustomOperationResponse',
        'DeleteShipFilesRequest' => 'ConnectshipBundle\\AMP\\DeleteShipFilesRequest',
        'DeleteShipFilesResponse' => 'ConnectshipBundle\\AMP\\DeleteShipFilesResponse',
        'DeleteTransmitItemsRequest' => 'ConnectshipBundle\\AMP\\DeleteTransmitItemsRequest',
        'DeleteTransmitItemsResponse' => 'ConnectshipBundle\\AMP\\DeleteTransmitItemsResponse',
        'GetGroupRequest' => 'ConnectshipBundle\\AMP\\GetGroupRequest',
        'GetGroupResponse' => 'ConnectshipBundle\\AMP\\GetGroupResponse',
        'GetSchemaRequest' => 'ConnectshipBundle\\AMP\\GetSchemaRequest',
        'GetSchemaResponse' => 'ConnectshipBundle\\AMP\\GetSchemaResponse',
        'GetShipperInformationRequest' => 'ConnectshipBundle\\AMP\\GetShipperInformationRequest',
        'GetShipperInformationResponse' => 'ConnectshipBundle\\AMP\\GetShipperInformationResponse',
        'ListCarriersRequest' => 'ConnectshipBundle\\AMP\\ListCarriersRequest',
        'ListCarriersResponse' => 'ConnectshipBundle\\AMP\\ListCarriersResponse',
        'ListCloseOutItemsRequest' => 'ConnectshipBundle\\AMP\\ListCloseOutItemsRequest',
        'ListCloseOutItemsResponse' => 'ConnectshipBundle\\AMP\\ListCloseOutItemsResponse',
        'ListCountriesRequest' => 'ConnectshipBundle\\AMP\\ListCountriesRequest',
        'ListCountriesResponse' => 'ConnectshipBundle\\AMP\\ListCountriesResponse',
        'ListCountryServicesRequest' => 'ConnectshipBundle\\AMP\\ListCountryServicesRequest',
        'ListCountryServicesResponse' => 'ConnectshipBundle\\AMP\\ListCountryServicesResponse',
        'ListCurrenciesRequest' => 'ConnectshipBundle\\AMP\\ListCurrenciesRequest',
        'ListCurrenciesResponse' => 'ConnectshipBundle\\AMP\\ListCurrenciesResponse',
        'ListDocumentFormatsRequest' => 'ConnectshipBundle\\AMP\\ListDocumentFormatsRequest',
        'ListDocumentFormatsResponse' => 'ConnectshipBundle\\AMP\\ListDocumentFormatsResponse',
        'ListDocumentsRequest' => 'ConnectshipBundle\\AMP\\ListDocumentsRequest',
        'ListDocumentsResponse' => 'ConnectshipBundle\\AMP\\ListDocumentsResponse',
        'ListGroupingsRequest' => 'ConnectshipBundle\\AMP\\ListGroupingsRequest',
        'ListGroupingsResponse' => 'ConnectshipBundle\\AMP\\ListGroupingsResponse',
        'ListGroupsRequest' => 'ConnectshipBundle\\AMP\\ListGroupsRequest',
        'ListGroupsResponse' => 'ConnectshipBundle\\AMP\\ListGroupsResponse',
        'ListIncotermsRequest' => 'ConnectshipBundle\\AMP\\ListIncotermsRequest',
        'ListIncotermsResponse' => 'ConnectshipBundle\\AMP\\ListIncotermsResponse',
        'ListLocalPortsRequest' => 'ConnectshipBundle\\AMP\\ListLocalPortsRequest',
        'ListLocalPortsResponse' => 'ConnectshipBundle\\AMP\\ListLocalPortsResponse',
        'ListPackagingTypesRequest' => 'ConnectshipBundle\\AMP\\ListPackagingTypesRequest',
        'ListPackagingTypesResponse' => 'ConnectshipBundle\\AMP\\ListPackagingTypesResponse',
        'ListPaymentTypesRequest' => 'ConnectshipBundle\\AMP\\ListPaymentTypesRequest',
        'ListPaymentTypesResponse' => 'ConnectshipBundle\\AMP\\ListPaymentTypesResponse',
        'ListPrinterDevicesRequest' => 'ConnectshipBundle\\AMP\\ListPrinterDevicesRequest',
        'ListPrinterDevicesResponse' => 'ConnectshipBundle\\AMP\\ListPrinterDevicesResponse',
        'ListServicesRequest' => 'ConnectshipBundle\\AMP\\ListServicesRequest',
        'ListServicesResponse' => 'ConnectshipBundle\\AMP\\ListServicesResponse',
        'ListShipFilesRequest' => 'ConnectshipBundle\\AMP\\ListShipFilesRequest',
        'ListShipFilesResponse' => 'ConnectshipBundle\\AMP\\ListShipFilesResponse',
        'ListShippersRequest' => 'ConnectshipBundle\\AMP\\ListShippersRequest',
        'ListShippersResponse' => 'ConnectshipBundle\\AMP\\ListShippersResponse',
        'ListStocksRequest' => 'ConnectshipBundle\\AMP\\ListStocksRequest',
        'ListStocksResponse' => 'ConnectshipBundle\\AMP\\ListStocksResponse',
        'ListTransmitItemsRequest' => 'ConnectshipBundle\\AMP\\ListTransmitItemsRequest',
        'ListTransmitItemsResponse' => 'ConnectshipBundle\\AMP\\ListTransmitItemsResponse',
        'ListUnitsRequest' => 'ConnectshipBundle\\AMP\\ListUnitsRequest',
        'ListUnitsResponse' => 'ConnectshipBundle\\AMP\\ListUnitsResponse',
        'ListWindowsPrintersRequest' => 'ConnectshipBundle\\AMP\\ListWindowsPrintersRequest',
        'ListWindowsPrintersResponse' => 'ConnectshipBundle\\AMP\\ListWindowsPrintersResponse',
        'ModifyContainerRequest' => 'ConnectshipBundle\\AMP\\ModifyContainerRequest',
        'ModifyContainerResponse' => 'ConnectshipBundle\\AMP\\ModifyContainerResponse',
        'ModifyGroupRequest' => 'ConnectshipBundle\\AMP\\ModifyGroupRequest',
        'ModifyGroupResponse' => 'ConnectshipBundle\\AMP\\ModifyGroupResponse',
        'ModifyPackagesRequest' => 'ConnectshipBundle\\AMP\\ModifyPackagesRequest',
        'ModifyPackagesResponse' => 'ConnectshipBundle\\AMP\\ModifyPackagesResponse',
        'PrintItemList' => 'ConnectshipBundle\\AMP\\PrintItemList',
        'PrintRequest' => 'ConnectshipBundle\\AMP\\PrintRequest',
        'PrintResponse' => 'ConnectshipBundle\\AMP\\PrintResponse',
        'PrintXmlRequest' => 'ConnectshipBundle\\AMP\\PrintXmlRequest',
        'PrintXmlResponse' => 'ConnectshipBundle\\AMP\\PrintXmlResponse',
        'ServiceList' => 'ConnectshipBundle\\AMP\\ServiceList',
        'RateRequest' => 'ConnectshipBundle\\AMP\\RateRequest',
        'RateResponse' => 'ConnectshipBundle\\AMP\\RateResponse',
        'ReprocessRequest' => 'ConnectshipBundle\\AMP\\ReprocessRequest',
        'ReprocessResponse' => 'ConnectshipBundle\\AMP\\ReprocessResponse',
        'SearchRequest' => 'ConnectshipBundle\\AMP\\SearchRequest',
        'SearchResponse' => 'ConnectshipBundle\\AMP\\SearchResponse',
        'ShipRequest' => 'ConnectshipBundle\\AMP\\ShipRequest',
        'ShipResponse' => 'ConnectshipBundle\\AMP\\ShipResponse',
        'TransmitRequest' => 'ConnectshipBundle\\AMP\\TransmitRequest',
        'TransmitResponse' => 'ConnectshipBundle\\AMP\\TransmitResponse',
        'ValidateAddressRequest' => 'ConnectshipBundle\\AMP\\ValidateAddressRequest',
        'ValidateAddressResponse' => 'ConnectshipBundle\\AMP\\ValidateAddressResponse',
        'VoidPackagesRequest' => 'ConnectshipBundle\\AMP\\VoidPackagesRequest',
        'VoidPackagesResponse' => 'ConnectshipBundle\\AMP\\VoidPackagesResponse',
        'ErrorResponse' => 'ConnectshipBundle\\AMP\\ErrorResponse',
        'CompoundOperation' => 'ConnectshipBundle\\AMP\\CompoundOperation',
        'CompoundResult' => 'ConnectshipBundle\\AMP\\CompoundResult',
        'AddHolidayRequest' => 'ConnectshipBundle\\AMP\\AddHolidayRequest',
        'AddHolidayResponse' => 'ConnectshipBundle\\AMP\\AddHolidayResponse',
        'AddShipperRequest' => 'ConnectshipBundle\\AMP\\AddShipperRequest',
        'AddShipperResponse' => 'ConnectshipBundle\\AMP\\AddShipperResponse',
        'DeleteHolidayRequest' => 'ConnectshipBundle\\AMP\\DeleteHolidayRequest',
        'DeleteHolidayResponse' => 'ConnectshipBundle\\AMP\\DeleteHolidayResponse',
        'DeleteShipperRequest' => 'ConnectshipBundle\\AMP\\DeleteShipperRequest',
        'DeleteShipperResponse' => 'ConnectshipBundle\\AMP\\DeleteShipperResponse',
        'ExecuteHookRequest' => 'ConnectshipBundle\\AMP\\ExecuteHookRequest',
        'ExecuteHookResponse' => 'ConnectshipBundle\\AMP\\ExecuteHookResponse',
        'GetCategoryPropertyRequest' => 'ConnectshipBundle\\AMP\\GetCategoryPropertyRequest',
        'GetCategoryPropertyResponse' => 'ConnectshipBundle\\AMP\\GetCategoryPropertyResponse',
        'GetCategoryShipperErrorStatusRequest' => 'ConnectshipBundle\\AMP\\GetCategoryShipperErrorStatusRequest',
        'GetCategoryShipperErrorStatusResponse' => 'ConnectshipBundle\\AMP\\GetCategoryShipperErrorStatusResponse',
        'GetComponentConfigurationAssemblyRequest' => 'ConnectshipBundle\\AMP\\GetComponentConfigurationAssemblyRequest',
        'GetComponentConfigurationAssemblyResponse' => 'ConnectshipBundle\\AMP\\GetComponentConfigurationAssemblyResponse',
        'GetHolidaysRequest' => 'ConnectshipBundle\\AMP\\GetHolidaysRequest',
        'GetHolidaysResponse' => 'ConnectshipBundle\\AMP\\GetHolidaysResponse',
        'GetHooksSchemaRequest' => 'ConnectshipBundle\\AMP\\GetHooksSchemaRequest',
        'GetHooksSchemaResponse' => 'ConnectshipBundle\\AMP\\GetHooksSchemaResponse',
        'GetServerErrorStatusRequest' => 'ConnectshipBundle\\AMP\\GetServerErrorStatusRequest',
        'GetServerErrorStatusResponse' => 'ConnectshipBundle\\AMP\\GetServerErrorStatusResponse',
        'GetShipperConfigDataRequest' => 'ConnectshipBundle\\AMP\\GetShipperConfigDataRequest',
        'GetShipperConfigDataResponse' => 'ConnectshipBundle\\AMP\\GetShipperConfigDataResponse',
        'GetShipperConfigSchemaRequest' => 'ConnectshipBundle\\AMP\\GetShipperConfigSchemaRequest',
        'GetShipperConfigSchemaResponse' => 'ConnectshipBundle\\AMP\\GetShipperConfigSchemaResponse',
        'GetShipperControlDataRequest' => 'ConnectshipBundle\\AMP\\GetShipperControlDataRequest',
        'GetShipperControlDataResponse' => 'ConnectshipBundle\\AMP\\GetShipperControlDataResponse',
        'GetShipperControlSchemaRequest' => 'ConnectshipBundle\\AMP\\GetShipperControlSchemaRequest',
        'GetShipperControlSchemaResponse' => 'ConnectshipBundle\\AMP\\GetShipperControlSchemaResponse',
        'GetShipperErrorStatusRequest' => 'ConnectshipBundle\\AMP\\GetShipperErrorStatusRequest',
        'GetShipperErrorStatusResponse' => 'ConnectshipBundle\\AMP\\GetShipperErrorStatusResponse',
        'ListServersRequest' => 'ConnectshipBundle\\AMP\\ListServersRequest',
        'ListServersResponse' => 'ConnectshipBundle\\AMP\\ListServersResponse',
        'RegisterShipperRequest' => 'ConnectshipBundle\\AMP\\RegisterShipperRequest',
        'RegisterShipperResponse' => 'ConnectshipBundle\\AMP\\RegisterShipperResponse',
        'SetShipperAbbreviationRequest' => 'ConnectshipBundle\\AMP\\SetShipperAbbreviationRequest',
        'SetShipperAbbreviationResponse' => 'ConnectshipBundle\\AMP\\SetShipperAbbreviationResponse',
        'SetShipperConfigInfoRequest' => 'ConnectshipBundle\\AMP\\SetShipperConfigInfoRequest',
        'SetShipperConfigInfoResponse' => 'ConnectshipBundle\\AMP\\SetShipperConfigInfoResponse',
        'SetShipperControlInfoRequest' => 'ConnectshipBundle\\AMP\\SetShipperControlInfoRequest',
        'SetShipperControlInfoResponse' => 'ConnectshipBundle\\AMP\\SetShipperControlInfoResponse',
        'SetShipperNameAddressRequest' => 'ConnectshipBundle\\AMP\\SetShipperNameAddressRequest',
        'SetShipperNameAddressResponse' => 'ConnectshipBundle\\AMP\\SetShipperNameAddressResponse',
        'UnRegisterShipperRequest' => 'ConnectshipBundle\\AMP\\UnRegisterShipperRequest',
        'UnRegisterShipperResponse' => 'ConnectshipBundle\\AMP\\UnRegisterShipperResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null) {

        foreach (self::$classmap as $key => $value) {
            if (!isset($options['classmap'][$key])) {
                $options['classmap'][$key] = $value;
            }
        }
        $options = array_merge(array(
            'features' => 1,
                ), $options);
        if (!$wsdl) {
            $wsdl = 'http://wt-cs/amp/wsdl';
        }
        parent::__construct($wsdl, $options);
    }

    /**
     * Closes out a group of shipped packages.
     *
     * @param CloseOutRequest $body
     * @return void
     */
    public function CloseOut(CloseOutRequest $body) {
        return $this->__soapCall('CloseOut', array($body));
    }

    /**
     * Creates a new group using the specified data.
     *
     * @param CreateGroupRequest $body
     * @return void
     */
    public function CreateGroup(CreateGroupRequest $body) {
        return $this->__soapCall('CreateGroup', array($body));
    }

    /**
     * Performs a custom operation using the specified data.
     *
     * @param CustomOperationRequest $body
     * @return void
     */
    public function CustomOperation(CustomOperationRequest $body) {
        return $this->__soapCall('CustomOperation', array($body));
    }

    /**
     * Deletes a list of ship file items.
     *
     * @param DeleteShipFilesRequest $body
     * @return void
     */
    public function DeleteShipFiles(DeleteShipFilesRequest $body) {
        return $this->__soapCall('DeleteShipFiles', array($body));
    }

    /**
     * Deletes a list of transmit items.
     *
     * @param DeleteTransmitItemsRequest $body
     * @return void
     */
    public function DeleteTransmitItems(DeleteTransmitItemsRequest $body) {
        return $this->__soapCall('DeleteTransmitItems', array($body));
    }

    /**
     * Gets the detailed information about a group.
     *
     * @param GetGroupRequest $body
     * @return void
     */
    public function GetGroup(GetGroupRequest $body) {
        return $this->__soapCall('GetGroup', array($body));
    }

    /**
     * Gets the current AMP message XML schema.
     *
     * @param GetSchemaRequest $body
     * @return void
     */
    public function GetSchema(GetSchemaRequest $body) {
        return $this->__soapCall('GetSchema', array($body));
    }

    /**
     * Gets the detailed information about a shipper.
     *
     * @param GetShipperInformationRequest $body
     * @return void
     */
    public function GetShipperInformation(GetShipperInformationRequest $body) {
        return $this->__soapCall('GetShipperInformation', array($body));
    }

    /**
     * Gets the list of available carriers.
     *
     * @param ListCarriersRequest $body
     * @return void
     */
    public function ListCarriers(ListCarriersRequest $body) {
        return $this->__soapCall('ListCarriers', array($body));
    }

    /**
     * Gets the list of available close out items.
     *
     * @param ListCloseOutItemsRequest $body
     * @return void
     */
    public function ListCloseOutItems(ListCloseOutItemsRequest $body) {
        return $this->__soapCall('ListCloseOutItems', array($body));
    }

    /**
     * Gets the list of available countries.
     *
     * @param ListCountriesRequest $body
     * @return void
     */
    public function ListCountries(ListCountriesRequest $body) {
        return $this->__soapCall('ListCountries', array($body));
    }

    /**
     * Gets the list of services for a country.
     *
     * @param ListCountryServicesRequest $body
     * @return void
     */
    public function ListCountryServices(ListCountryServicesRequest $body) {
        return $this->__soapCall('ListCountryServices', array($body));
    }

    /**
     * Gets the list of available currencies.
     *
     * @param ListCurrenciesRequest $body
     * @return void
     */
    public function ListCurrencies(ListCurrenciesRequest $body) {
        return $this->__soapCall('ListCurrencies', array($body));
    }

    /**
     * Gets the list of available documents.
     *
     * @param ListDocumentsRequest $body
     * @return void
     */
    public function ListDocuments(ListDocumentsRequest $body) {
        return $this->__soapCall('ListDocuments', array($body));
    }

    /**
     * Gets the list of available formats for a document.
     *
     * @param ListDocumentFormatsRequest $body
     * @return void
     */
    public function ListDocumentFormats(ListDocumentFormatsRequest $body) {
        return $this->__soapCall('ListDocumentFormats', array($body));
    }

    /**
     * Gets the list of supported groupings for a carrier.
     *
     * @param ListGroupingsRequest $body
     * @return void
     */
    public function ListGroupings(ListGroupingsRequest $body) {
        return $this->__soapCall('ListGroupings', array($body));
    }

    /**
     * Gets the list of available groups for a grouping.
     *
     * @param ListGroupsRequest $body
     * @return void
     */
    public function ListGroups(ListGroupsRequest $body) {
        return $this->__soapCall('ListGroups', array($body));
    }

    /**
     * Gets the list of available Incoterms.
     *
     * @param ListIncotermsRequest $body
     * @return void
     */
    public function ListIncoterms(ListIncotermsRequest $body) {
        return $this->__soapCall('ListIncoterms', array($body));
    }

    /**
     * Gets the list of local printer ports.
     *
     * @param ListLocalPortsRequest $body
     * @return void
     */
    public function ListLocalPorts(ListLocalPortsRequest $body) {
        return $this->__soapCall('ListLocalPorts', array($body));
    }

    /**
     * Gets the list of available packaging types.
     *
     * @param ListPackagingTypesRequest $body
     * @return void
     */
    public function ListPackagingTypes(ListPackagingTypesRequest $body) {
        return $this->__soapCall('ListPackagingTypes', array($body));
    }

    /**
     * Gets the list of available payment types.
     *
     * @param ListPaymentTypesRequest $body
     * @return void
     */
    public function ListPaymentTypes(ListPaymentTypesRequest $body) {
        return $this->__soapCall('ListPaymentTypes', array($body));
    }

    /**
     * Gets the list of available printer devices.
     *
     * @param ListPrinterDevicesRequest $body
     * @return void
     */
    public function ListPrinterDevices(ListPrinterDevicesRequest $body) {
        return $this->__soapCall('ListPrinterDevices', array($body));
    }

    /**
     * Gets the list of available carrier services.
     *
     * @param ListServicesRequest $body
     * @return void
     */
    public function ListServices(ListServicesRequest $body) {
        return $this->__soapCall('ListServices', array($body));
    }

    /**
     * Gets the list of available ship file items for a carrier and shipper.
     *
     * @param ListShipFilesRequest $body
     * @return void
     */
    public function ListShipFiles(ListShipFilesRequest $body) {
        return $this->__soapCall('ListShipFiles', array($body));
    }

    /**
     * Gets the list of available shippers.
     *
     * @param ListShippersRequest $body
     * @return void
     */
    public function ListShippers(ListShippersRequest $body) {
        return $this->__soapCall('ListShippers', array($body));
    }

    /**
     * Gets the list of available printer stocks.
     *
     * @param ListStocksRequest $body
     * @return void
     */
    public function ListStocks(ListStocksRequest $body) {
        return $this->__soapCall('ListStocks', array($body));
    }

    /**
     * Gets the list of available transmit items for a carrier and shipper.
     *
     * @param ListTransmitItemsRequest $body
     * @return void
     */
    public function ListTransmitItems(ListTransmitItemsRequest $body) {
        return $this->__soapCall('ListTransmitItems', array($body));
    }

    /**
     * Gets the list of available units of measurement.
     *
     * @param ListUnitsRequest $body
     * @return void
     */
    public function ListUnits(ListUnitsRequest $body) {
        return $this->__soapCall('ListUnits', array($body));
    }

    /**
     * Gets the list of printers configured through Windows.
     *
     * @param ListWindowsPrintersRequest $body
     * @return ListWindowsPrintersResponse
     */
    public function ListWindowsPrinters(ListWindowsPrintersRequest $body) {
        return $this->__soapCall('ListWindowsPrinters', array($body));
    }

    /**
     * Modifies data for a previously saved container.
     *
     * @param ModifyContainerRequest $body
     * @return void
     */
    public function ModifyContainer(ModifyContainerRequest $body) {
        return $this->__soapCall('ModifyContainer', array($body));
    }

    /**
     * Modifies data and/or status for a group
     *
     * @param ModifyGroupRequest $body
     * @return void
     */
    public function ModifyGroup(ModifyGroupRequest $body) {
        return $this->__soapCall('ModifyGroup', array($body));
    }

    /**
     * Modifies data and/or close out mode for a list of packages.
     *
     * @param ModifyPackagesRequest $body
     * @return void
     */
    public function ModifyPackages(ModifyPackagesRequest $body) {
        return $this->__soapCall('ModifyPackages', array($body));
    }

    /**
     * Prints or saves a document.
     *
     * @param PrintRequest $body
     * @return void
     */
    public function aPrint(PrintRequest $body) {
        return $this->__soapCall('Print', array($body));
    }

    /**
     * Prints or saves a document from its XML representation.
     *
     * @param PrintXmlRequest $body
     * @return void
     */
    public function PrintXml(PrintXmlRequest $body) {
        return $this->__soapCall('PrintXml', array($body));
    }

    /**
     * Rates a list of packages using the specified services.
     *
     * @param RateRequest $body
     * @return void
     */
    public function Rate(RateRequest $body) {
        return $this->__soapCall('Rate', array($body));
    }

    /**
     * Reprocesses a list of already shipped packages.
     *
     * @param ReprocessRequest $body
     * @return void
     */
    public function Reprocess(ReprocessRequest $body) {
        return $this->__soapCall('Reprocess', array($body));
    }

    /**
     * Searches for packages based on the specified criteria
     *
     * @param SearchRequest $body
     * @return SearchResponse
     */
    public function Search(SearchRequest $body) {
        return $this->__soapCall('Search', array($body));
    }

    /**
     * Ships a list of packages using the specified service.
     *
     * @param ShipRequest $body
     * @return void
     */
    public function Ship(ShipRequest $body) {
        return $this->__soapCall('Ship', array($body));
    }

    /**
     * Transmits or offloads a list of transmit items.
     *
     * @param TransmitRequest $body
     * @return void
     */
    public function Transmit(TransmitRequest $body) {
        return $this->__soapCall('Transmit', array($body));
    }

    /**
     * Validates the specified address.
     *
     * @param ValidateAddressRequest $body
     * @return void
     */
    public function ValidateAddress(ValidateAddressRequest $body) {
        return $this->__soapCall('ValidateAddress', array($body));
    }

    /**
     * Voids a list of shipped packages.
     *
     * @param VoidPackagesRequest $body
     * @return void
     */
    public function VoidPackages(VoidPackagesRequest $body) {
        return $this->__soapCall('VoidPackages', array($body));
    }

    /**
     * Executes a list of operations in a single request.
     *
     * @param CompoundOperation $body
     * @return void
     */
    public function Compound(CompoundOperation $body) {
        return $this->__soapCall('Compound', array($body));
    }

    /**
     * Adds holiday
     *
     * @param AddHolidayRequest $body
     * @return void
     */
    public function AddHoliday(AddHolidayRequest $body) {
        return $this->__soapCall('AddHoliday', array($body));
    }

    /**
     * Adds a shipper
     *
     * @param AddShipperRequest $body
     * @return void
     */
    public function AddShipper(AddShipperRequest $body) {
        return $this->__soapCall('AddShipper', array($body));
    }

    /**
     * Deletes holiday
     *
     * @param DeleteHolidayRequest $body
     * @return void
     */
    public function DeleteHoliday(DeleteHolidayRequest $body) {
        return $this->__soapCall('DeleteHoliday', array($body));
    }

    /**
     * Deletes a shipper
     *
     * @param DeleteShipperRequest $body
     * @return void
     */
    public function DeleteShipper(DeleteShipperRequest $body) {
        return $this->__soapCall('DeleteShipper', array($body));
    }

    /**
     * Executes a hook
     *
     * @param ExecuteHookRequest $body
     * @return void
     */
    public function ExecuteHook(ExecuteHookRequest $body) {
        return $this->__soapCall('ExecuteHook', array($body));
    }

    /**
     * Gets category property
     *
     * @param GetCategoryPropertyRequest $body
     * @return void
     */
    public function GetCategoryProperty(GetCategoryPropertyRequest $body) {
        return $this->__soapCall('GetCategoryProperty', array($body));
    }

    /**
     * Gets category shipper error status
     *
     * @param GetCategoryShipperErrorStatusRequest $body
     * @return void
     */
    public function GetCategoryShipperErrorStatus(GetCategoryShipperErrorStatusRequest $body) {
        return $this->__soapCall('GetCategoryShipperErrorStatus', array($body));
    }

    /**
     * Gets Progistics Management Console component configuration assembly (for internal use only)
     *
     * @param GetComponentConfigurationAssemblyRequest $body
     * @return void
     */
    public function GetComponentConfigurationAssembly(GetComponentConfigurationAssemblyRequest $body) {
        return $this->__soapCall('GetComponentConfigurationAssembly', array($body));
    }

    /**
     * Gets holidays
     *
     * @param GetHolidaysRequest $body
     * @return void
     */
    public function GetHolidays(GetHolidaysRequest $body) {
        return $this->__soapCall('GetHolidays', array($body));
    }

    /**
     * Gets hooks schema
     *
     * @param GetHooksSchemaRequest $body
     * @return void
     */
    public function GetHooksSchema(GetHooksSchemaRequest $body) {
        return $this->__soapCall('GetHooksSchema', array($body));
    }

    /**
     * Gets Server Error Status
     *
     * @param GetServerErrorStatusRequest $body
     * @return void
     */
    public function GetServerErrorStatus(GetServerErrorStatusRequest $body) {
        return $this->__soapCall('GetServerErrorStatus', array($body));
    }

    /**
     * Gets shipper configuration data
     *
     * @param GetShipperConfigDataRequest $body
     * @return void
     */
    public function GetShipperConfigData(GetShipperConfigDataRequest $body) {
        return $this->__soapCall('GetShipperConfigData', array($body));
    }

    /**
     * Gets shipper configuration schema
     *
     * @param GetShipperConfigSchemaRequest $body
     * @return void
     */
    public function GetShipperConfigSchema(GetShipperConfigSchemaRequest $body) {
        return $this->__soapCall('GetShipperConfigSchema', array($body));
    }

    /**
     * Gets shipper control data
     *
     * @param GetShipperControlDataRequest $body
     * @return void
     */
    public function GetShipperControlData(GetShipperControlDataRequest $body) {
        return $this->__soapCall('GetShipperControlData', array($body));
    }

    /**
     * Gets shipper control schema
     *
     * @param GetShipperControlSchemaRequest $body
     * @return void
     */
    public function GetShipperControlSchema(GetShipperControlSchemaRequest $body) {
        return $this->__soapCall('GetShipperControlSchema', array($body));
    }

    /**
     * Gets shipper error status
     *
     * @param GetShipperErrorStatusRequest $body
     * @return void
     */
    public function GetShipperErrorStatus(GetShipperErrorStatusRequest $body) {
        return $this->__soapCall('GetShipperErrorStatus', array($body));
    }

    /**
     * Lists Servers
     *
     * @param ListServersRequest $body
     * @return void
     */
    public function ListServers(ListServersRequest $body) {
        return $this->__soapCall('ListServers', array($body));
    }

    /**
     * Registers a shipper
     *
     * @param RegisterShipperRequest $body
     * @return void
     */
    public function RegisterShipper(RegisterShipperRequest $body) {
        return $this->__soapCall('RegisterShipper', array($body));
    }

    /**
     * Sets shipper abbreviation
     *
     * @param SetShipperAbbreviationRequest $body
     * @return void
     */
    public function SetShipperAbbreviation(SetShipperAbbreviationRequest $body) {
        return $this->__soapCall('SetShipperAbbreviation', array($body));
    }

    /**
     * Sets shipper configuration information
     *
     * @param SetShipperConfigInfoRequest $body
     * @return void
     */
    public function SetShipperConfigInfo(SetShipperConfigInfoRequest $body) {
        return $this->__soapCall('SetShipperConfigInfo', array($body));
    }

    /**
     * Sets shipper control information
     *
     * @param SetShipperControlInfoRequest $body
     * @return void
     */
    public function SetShipperControlInfo(SetShipperControlInfoRequest $body) {
        return $this->__soapCall('SetShipperControlInfo', array($body));
    }

    /**
     * Sest shipper name/address
     *
     * @param SetShipperNameAddressRequest $body
     * @return void
     */
    public function SetShipperNameAddress(SetShipperNameAddressRequest $body) {
        return $this->__soapCall('SetShipperNameAddress', array($body));
    }

    /**
     * Unregisters a shipper
     *
     * @param UnRegisterShipperRequest $body
     * @return void
     */
    public function UnRegisterShipper(UnRegisterShipperRequest $body) {
        return $this->__soapCall('UnRegisterShipper', array($body));
    }

}
