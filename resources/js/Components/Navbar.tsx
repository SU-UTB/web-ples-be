import {Avatar, Dropdown, Navbar as FbNavbar} from 'flowbite-react';
import React from "react";
import {Link, router} from "@inertiajs/react";

interface INavbar {
    title: string,
    auth: any
}

export const Navbar = ({title, auth}: INavbar) => {
    console.log(auth);
    return (
        <FbNavbar fluid rounded className={'bg-[#f8f9fa]'}>
            <FbNavbar.Brand href="/admin">
                <span
                    className="self-center whitespace-nowrap text-xl font-semibold dark:text-white">{title}</span>
            </FbNavbar.Brand>
            <div className="flex md:order-2">
                <Dropdown
                    arrowIcon={false}
                    inline
                    label={
                        <Avatar alt="User settings" img="/images/user.png"
                                rounded/>
                    }
                >
                    <Dropdown.Header>
                        <span className="block text-sm">{auth.user.name}</span>
                        <span className="block truncate text-sm font-medium">{auth.user.email}</span>
                    </Dropdown.Header>

                    <Dropdown.Item onClick={() => router.visit('logout',
                        {method: 'post'})}>
                        Sign out
                    </Dropdown.Item>
                </Dropdown>
                <FbNavbar.Toggle/>
            </div>

        </FbNavbar>
    );
}
