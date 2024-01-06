import React from "react";
import {Card as FbCard} from "flowbite-react";
import {FaUserAlt} from "react-icons/fa";

interface ICard {
    title1: string;
    data1: string;
    title2: string | null;
    data2: string | null;
}

export const Card = ({title1, data1, title2 = null, data2 = null}: ICard) => {
    return <FbCard href="#" className="max-w-sm">
        <div className={'flex flex-row gap-6 justify-stretch h-full' }>
{/*
            <FaUserAlt className={'mt-2'}/>
*/}
            <div className={'w-full'}>
                <div className='flex flex-row justify-between items-center'>
                    <h5 className="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {title1}
                    </h5>
                    <p className="font-normal text-gray-700 dark:text-gray-400">
                        {data1}
                    </p>
                </div>

                {
                    (title2 && data2) ?
                        <div className='flex flex-row justify-between items-center'>
                            <h5 className="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {title2}
                            </h5>
                            <p className="font-normal text-gray-700 dark:text-gray-400">
                                {data2}
                            </p>
                        </div> : <></>
                }
            </div>
        </div>
    </FbCard>
}
