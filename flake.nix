{
  description = "A flake that's used to develop this project";

  inputs = {
    nixpkgs.url = "github:nixos/nixpkgs/99fcf0ee74957231ff0471228e9a59f976a0266b";
    flake-utils.url = "github:numtide/flake-utils";
  };

  outputs = { self, nixpkgs, flake-utils }:
    flake-utils.lib.eachDefaultSystem
      (system:
        let
          pkgs = nixpkgs.legacyPackages.x86_64-linux;
        in
        with pkgs;
        {
          devShells.default = pkgs.mkShell {
            buildInputs = [php74 nodejs];
          };
        }
      );
}
