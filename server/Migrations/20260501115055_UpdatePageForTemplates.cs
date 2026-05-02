using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ThstiServer.Migrations
{
    /// <inheritdoc />
    public partial class UpdatePageForTemplates : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "IsVisualBuilder",
                table: "Page");

            migrationBuilder.RenameColumn(
                name: "PageDataJson",
                table: "Page",
                newName: "TemplateConfigJson");

            migrationBuilder.AddColumn<string>(
                name: "BannerImageUrl",
                table: "Page",
                type: "nvarchar(max)",
                nullable: true);

            migrationBuilder.AddColumn<string>(
                name: "BreadcrumbTitle",
                table: "Page",
                type: "nvarchar(max)",
                nullable: true);

            migrationBuilder.AddColumn<string>(
                name: "PageType",
                table: "Page",
                type: "nvarchar(max)",
                nullable: false,
                defaultValue: "");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "BannerImageUrl",
                table: "Page");

            migrationBuilder.DropColumn(
                name: "BreadcrumbTitle",
                table: "Page");

            migrationBuilder.DropColumn(
                name: "PageType",
                table: "Page");

            migrationBuilder.RenameColumn(
                name: "TemplateConfigJson",
                table: "Page",
                newName: "PageDataJson");

            migrationBuilder.AddColumn<bool>(
                name: "IsVisualBuilder",
                table: "Page",
                type: "bit",
                nullable: false,
                defaultValue: false);
        }
    }
}
