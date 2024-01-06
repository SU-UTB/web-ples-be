import React, {useState} from 'react';
import Header from "../Components/Header";
import {Sidebar} from "../Components/Sidebar";
import {Navbar} from "../Components/Navbar";
import {Head} from "@inertiajs/react";

export default function AuthenticatedLayout({auth, header, children}) {

    return <div className="dark:bg-boxdark-2 dark:text-bodydark">
        <div className="flex h-screen overflow-hidden">

            <Sidebar/>

            <div className="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
                {/* <!-- ===== Header Start ===== --> */}
                <Navbar title={header} auth={auth}/>
                {/* <!-- ===== Header End ===== --> */}

                {/* <!-- ===== Main Content Start ===== --> */}
                <main>
                    <div className="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                        <Head title={header}/>

                        {children}
                    </div>
                </main>
                {/* <!-- ===== Main Content End ===== --> */}
            </div>
            {/* <!-- ===== Content Area End ===== --> */}
        </div>
        {/* <!-- ===== Page Wrapper End ===== --> */}
    </div>;


}
