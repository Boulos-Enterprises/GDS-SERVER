// 

import React from 'react';
import { createInertiaApp } from '@inertiajs/inertia-react';
import { render } from 'react-dom';
import { InertiaProgress } from '@inertiajs/progress';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Home from './Pages/Auth'
createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true });
        return pages[`./Pages/${name}.jsx`].default;
    },
    // setup({ el, App, props }) {
    //     render(<App {...props} />, el);
    // },
    setup({ el, App, props }) {
        render(
            <Router>
                <Routes>
                    <Route path="/" element={<Home />} />
                </Routes>
            </Router>,
            el
        );
    },
});

InertiaProgress.init();
