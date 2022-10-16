import React, {useEffect, useState} from "react";
import CardAds from "../Card/Card";


export default function FetchApi () {
    const [ads, getAds] = useState([]);

    const getAllAds = () => {
        fetch('https://127.0.01:8001/api/annonces')
        .then((response) => response.json())
        .then((json) => {
            console.log(json);
            getAds(json['hydra:member']);
            
        });
    };
    useEffect(() => {
        getAllAds()
    }, [])



    return (
    
        <CardAds ads={ads} />
    )
}

