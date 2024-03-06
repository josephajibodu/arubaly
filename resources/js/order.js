import { Modal } from 'flowbite';

let selectedMerchant = null;

// set the modal menu element
const $targetEl = document.getElementById('buy-awg');

const modalOptions = {
    placement: 'bottom-right',
    backdrop: 'dynamic',
    backdropClasses:
        'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
    closable: true,
    onHide: () => {
        console.log('modal is hidden');
    },
    onShow: () => {
        console.log('modal is shown');
    },
    onToggle: () => {
        console.log('modal has been toggled');
    },
};

// instance options object
const instanceOptions = {
    id: 'modalEl',
    override: true
};

const modal = new Modal($targetEl, modalOptions, instanceOptions);

function setMerchant(name) {
    selectedMerchant = name
}
