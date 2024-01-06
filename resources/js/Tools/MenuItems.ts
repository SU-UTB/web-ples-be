import {
    FaTable,
    FaMoneyBill,
    FaPersonDressBurst,
    FaPenToSquare,
    FaUserPen,
    FaTicket
} from 'react-icons/fa6';
import {IconType} from "react-icons";


interface IMenuItem {
    title: string,
    route: string,
    link: string,
    icon: IconType,
}

export const MenuItems: Array<IMenuItem> = [
    {
        title: 'Dashboard',
        route: 'dashboard',
        link: '/admin',
        icon: FaTable
    }, {
        title: 'Rezervace',
        route: 'reservations',
        link: '/admin/reservations',
        icon: FaMoneyBill
    }, {
        title: 'Salony',
        route: 'makers',
        link: '/admin/makers',
        icon: FaPersonDressBurst
    }, {
        title: 'Edit webu',
        route: 'landingEdit',
        link: '/admin/makers',
        icon: FaPenToSquare
    }, {
        title: 'Edit kontaktů',
        route: 'contactsEdit',
        link: '/admin/makers',
        icon: FaUserPen
    }, {
        title: 'Edit lístků',
        route: 'ticketsEdit',
        link: '/admin/makers',
        icon: FaTicket
    }
]
