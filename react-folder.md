- Recommended Folder Structure for Scalable Apps

src/
├── app/ # Root application setup, routing, and global providers
├── features/ # The core of your application organized by domain
├── shared/ # Reusable, non-domain-specific code (UI library, general utils)
├── infrastructure/ # Code that interacts with external services (APIs, auth providers)
├── tests/ # Global testing utilities and mocks
├── styles/ # Global CSS files, themes, and design tokens
├── assets/ # Static files like images, fonts, and icons
├── lib/ # Library facades or custom wrappers for third-party libraries
├── utils/ # Small, pure helper functions used across the application
└── index.js # The main entry point of the application
