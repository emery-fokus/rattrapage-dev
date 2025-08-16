"use client";
import React, { useEffect, useState } from 'react';
import './Pokemonstyle.css';

const API_URL = 'http://localhost:8000/api/pokemons';

function PokemonList() {
    const [pokemons, setPokemons] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetch(API_URL)
            .then(response => {
                if (!response.ok) throw new Error('Erreur de chargement');
                return response.json();
            })
            .then(data => {
                setPokemons(data);
                setLoading(false);
            })
            .catch(error => {
                console.error('Erreur:', error);
                setLoading(false);
            });
    }, []);

    if (loading) return <p>Chargement...</p>;

    return (
        <div className="pokemon-list">
            {pokemons.map(pokemon => (
                <div key={pokemon.id} className="pokemon-card">
                    <h3 className="pokemon-name">{pokemon.name}</h3>
                    <p className="pokemon-id">#{pokemon.pokeApiId}</p>
                    <img src={pokemon.image} alt={pokemon.name} className="pokemon-image" />
                    <img src={pokemon.spriteFront} alt={`${pokemon.name} sprite`} className="pokemon-sprite" />
                    {pokemon.spriteShiny && (
                        <img src={pokemon.spriteShiny} alt={`${pokemon.name} shiny`} className="pokemon-sprite" />
                    )}
                    <p>Type : {pokemon.type1}{pokemon.type2 ? ` / ${pokemon.type2}` : ''}</p>
                </div>
            ))}
        </div>
    );
}

export default PokemonList;
