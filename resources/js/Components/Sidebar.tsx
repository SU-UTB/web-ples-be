import {Sidebar as FbSidebar, theme} from 'flowbite-react';
import {twMerge} from 'tailwind-merge';
import React from "react";
import {MenuItems} from "../Tools/MenuItems";

export const Sidebar = () => {
    return <FbSidebar aria-label="Sidebar">
        <FbSidebar.Logo href="#" img="/images/utb.png" imgAlt="Ples UTB">
            Ples UTB
        </FbSidebar.Logo>
        <FbSidebar.Items>
            <FbSidebar.ItemGroup>

                {MenuItems.map(item =>
                    <FbSidebar.Item
                        href={item.link}
                        icon={item.icon}
                        active={route().current(item.route)}
                    >
                        {item.title}
                    </FbSidebar.Item>)}

            </FbSidebar.ItemGroup>
        </FbSidebar.Items>
    </FbSidebar>
}
