<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Service;

use Comindware\Tracker\API\Model\Item;
use Comindware\Tracker\API\Service\ItemService;

/**
 * Tests for Comindware\Tracker\API\Service\ItemService.
 *
 * @covers Comindware\Tracker\API\Service\ItemService
 */
class ItemServiceTest extends ServiceTestCase
{
    /**
     * Basic checks for ItemService::query().
     */
    public function testQuery()
    {
        $client = $this->createClientMock(
            [
                [
                    '/Api/Items/Query?rangeSelector.skip=0',
                    'POST',
                    [
                        'expression' => 'true',
                        'sortByColumn' => 'id',
                        'sortDirection' => 'Ascending',
                        'properties' => ['foo', 'id']
                    ],
                    [
                        'properties' => [
                            ['id' => 'id', 'isSystem' => true],
                            ['id' => 'foo', 'isSystem' => false]
                        ],
                        'items' => [
                            [
                                'id' => [123],
                                'foo' => ['Foo']
                            ],
                            [
                                'id' => [456],
                                'foo' => ['Bar']
                            ]
                        ]
                    ]
                ]
            ]
        );
        /** @var ItemService $service */
        $service = $this->createService(ItemService::class, $client);

        $items = $service->query('true', ['foo']);

        static::assertCount(2, $items);
        foreach ($items as $item) {
            static::assertInstanceOf(Item::class, $item);
        }

        static::assertEquals('123', $items[0]->getId());
        static::assertNull($items[0]->getType());
        static::assertEquals('Foo', $items[0]->get('foo'));

        static::assertEquals('456', $items[1]->getId());
        static::assertNull($items[1]->getType());
        static::assertEquals('Bar', $items[1]->get('foo'));
    }
}
