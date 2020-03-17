<?php
namespace Vexpro\Nota\Ui\Component\Listing\Column;
 
use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;
 
use Magento\Framework\Pricing\PriceCurrencyInterface;
 
class Numnota extends Column
{
	protected $_orderRepository;
	protected $_searchCriteria;
 
	public function __construct(
    	PriceCurrencyInterface $priceCurrency,
    	ContextInterface $context,
    	UiComponentFactory $uiComponentFactory,
    	OrderRepositoryInterface $orderRepository,
    	SearchCriteriaBuilder $criteria,
    	array $components = [],
    	array $data = [])
	{
    	$this->_orderRepository = $orderRepository;
    	$this->_searchCriteria  = $criteria;
 
    	$this->priceCurrency = $priceCurrency;
    	parent::__construct($context, $uiComponentFactory, $components, $data);
	}
	public function prepareDataSource(array $dataSource)
	{
    	if (isset($dataSource['data']['items'])) {
        	foreach ($dataSource['data']['items'] as & $item) {
                $order  = $this->_orderRepository->get($item["entity_id"]);
                $num_nota = $order->getExtensionAttributes()->getNumeroNota();
            	$item[$this->getData('name')] = $num_nota;
        	}
    	}
    	return $dataSource;
	}
}