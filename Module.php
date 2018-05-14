<?php

namespace ItemExtend;

use Omeka\Module\AbstractModule;
use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\Mvc\Controller\AbstractController;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\EventManager\Event;

class Module extends AbstractModule
{
    /** Module body **/

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function install(ServiceLocatorInterface $serviceLocator)
    {

        $connection = $serviceLocator->get('Omeka\Connection');
        $sql = "CREATE TABLE item_extend (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, text VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_BD403CE3126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
        ALTER TABLE item_extend ADD CONSTRAINT FK_BD403CE3126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE;";

        $connection->exec($sql);
    }

    public function uninstall(ServiceLocatorInterface $serviceLocator)
    {
        $conn = $serviceLocator->get('Omeka\Connection');
        $conn->exec("DROP TABLE IF EXISTS item_extend;");
        
    }
    /**
     * Attach listeners to events.
     *
     * @param SharedEventManagerInterface $sharedEventManager
     */
    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        
        // Show
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.show.after',
            function (Event $event) {
                echo $event->getTarget()->partial('show');
            }
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Site\Item',
            'view.show.after',
            function (Event $event) {
                echo $event->getTarget()->partial('show');
            }
        );

        // Form 
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.add.form.after',
            function (Event $event) {
                echo $event->getTarget()->partial('form');
            }
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.edit.form.after',
            function (Event $event) {
                echo $event->getTarget()->partial('form');
            }
        );

        // Navigation Tab
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.add.section_nav',
            [$this, 'addExtraTab']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.edit.section_nav',
            [$this, 'addExtraTab']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.show.section_nav',
            [$this, 'addExtraTab']
        );
    
    }
    

    /**
     * Add the map tab to section navigations.
     *
     * Event $event
     */
    public function addExtraTab(Event $event)
    {
        $view = $event->getTarget();
        $sectionNav = $event->getParam('section_nav');
        $sectionNav['extra-section'] = $view->translate('Extra');
        $event->setParam('section_nav', $sectionNav);
    }

    /**
     * Add text field.
     *
     * Event $event
     */
    public function addElements(Event $event)
    {
        $form = $event->getParam('form');
        $fieldset = new Fieldset('example');
        $fieldset->setLabel('Example Fieldset');

        $fieldset->add([
                'name' => 'example',
                'type' => 'text',
                'options' => [
                    'label' => 'Example text input', // @translate
                ],
            ]);

        $form->add($fieldset);
    }
}

?>