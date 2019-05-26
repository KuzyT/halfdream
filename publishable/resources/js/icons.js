/**
* Created by KuzyT\Halfdream.
* Date: 2019-05-26
*/

import { library } from '@fortawesome/fontawesome-svg-core';

import { faUser as faUser } from '@fortawesome/free-solid-svg-icons/faUser';
import { faEnvelope as faEnvelope } from '@fortawesome/free-solid-svg-icons/faEnvelope';
import { faLock as faLock } from '@fortawesome/free-solid-svg-icons/faLock';
import { faExclamationTriangle as faExclamationTriangle } from '@fortawesome/free-solid-svg-icons/faExclamationTriangle';
import { faArrowLeft as faArrowLeft } from '@fortawesome/free-solid-svg-icons/faArrowLeft';
import { faArrowRight as faArrowRight } from '@fortawesome/free-solid-svg-icons/faArrowRight';
import { faPowerOff as faPowerOff } from '@fortawesome/free-solid-svg-icons/faPowerOff';
import { faHome as faHome } from '@fortawesome/free-solid-svg-icons/faHome';
import { faRss as faRss } from '@fortawesome/free-solid-svg-icons/faRss';
import { faFolderOpen as faFolderOpen } from '@fortawesome/free-solid-svg-icons/faFolderOpen';
import { faGithub as fabFaGithub } from '@fortawesome/free-brands-svg-icons/faGithub';
import { faVk as fabFaVk } from '@fortawesome/free-brands-svg-icons/faVk';
import { faPatreon as fabFaPatreon } from '@fortawesome/free-brands-svg-icons/faPatreon';
import { faHeart as faHeart } from '@fortawesome/free-solid-svg-icons/faHeart';
                                                                                                                                                                                                                                
(function () {
    library.add(
        faUser, faEnvelope, faLock, faExclamationTriangle, faArrowLeft, faArrowRight, faPowerOff, faHome, faRss, faFolderOpen, fabFaGithub, fabFaVk, fabFaPatreon, faHeart
    );
    return library;
})();